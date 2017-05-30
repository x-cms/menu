<?php

namespace Xcms\Menu\Supports;

class MenuManager
{
    /**
     * @var array
     */
    protected $widgetBoxes = [];

    /**
     * @var array
     */
    protected $objectInfoByType = [];

    /**
     * @param string $title
     * @param string $type
     * @param \Closure|array $data
     * @return $this
     */
    public function registerWidget($title, $type, $data)
    {
        $this->widgetBoxes[] = ['title' => $title, 'type' => $type, 'data' => $data,];

        return $this;
    }

    /**
     * @return array
     */
    public function getWidgets()
    {
        $widgets = $this->widgetBoxes;

        $result = [];

        /**
         * Resolve the data
         */
        foreach ($widgets as $widget) {
            $data = array_get($widget, 'data');
            if ($data instanceof \Closure) {
                $widget['data'] = call_user_func($data);
            }
            if (!is_array($widget['data']) || !$widget['data']) {
                continue;
            }
            $result[] = view('webed-menus::admin._components.widget', ['type' => $widget['type'], 'title' => $widget['title'], 'data' => $widget['data'],])->render();
        }

        return $result;
    }

    /**
     * @return string
     */
    public function renderWidgets()
    {
        $widgets = $this->getWidgets();
        $result = '';
        foreach ($widgets as $widget) {
            $result .= $widget;
        }
        return $result;
    }

    /**
     * @param $type
     * @param \Closure $callback
     * @return $this
     */
    public function registerLinkType($type, \Closure $callback)
    {
        $this->objectInfoByType[$type] = $callback;
        return $this;
    }

    /**
     * @param $type
     * @param array ...$params
     * @return array|null
     */
    public function getObjectInfoByType($type, ...$params)
    {
        if (!array_get($this->objectInfoByType, $type)) {
            return null;
        }
        $result = call_user_func_array($this->objectInfoByType[$type], $params);

        return (array)$result;
    }

    public function generateMenu($args = [])
    {
        $slug = array_get($args, 'slug');
        if (!$slug) {
            return null;
        }
        $parent_id = array_get($args, 'parent_id', 0);
        $active = array_get($args, 'active', true);
        $options = $this->html->attributes(array_get($args, 'options', []));

        $menu = $this->menuRepository->findBySlug($slug, $active, ['menus.id', 'menus.slug']);

        if (!$menu) {
            return null;
        }

        $menuContent = $this->menuContentRepository->getFirstBy(['menu_id' => $menu->id]);
        if (!$menuContent) {
            $menu_nodes = [];
        } else {
            $menu_nodes = $this->menuNodeRepository->getByMenuContentId($menuContent->id, $parent_id, [
                'id',
                'menu_content_id',
                'parent_id',
                'related_id',
                'icon_font',
                'css_class',
                'target',
                'url',
                'title',
                'type'
            ]);
        }

        return view('menu::partials.default', compact('menu_nodes', 'menu', 'options'))->render();
    }
}
