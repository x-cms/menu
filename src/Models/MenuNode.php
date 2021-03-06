<?php

namespace Xcms\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MenuNode extends Model
{
    protected $table = 'menu_nodes';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $relatedModelInfo = [];

    /**
     * @param $value
     * @return mixed|string
     */
    public function getTitleAttribute($value)
    {
        if ($value) {
            return $value;
        }
        if (!$this->resolveRelatedModel()) {
            return '';
        }

        return array_get($this->relatedModelInfo, 'model_title');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getUrlAttribute($value)
    {
        if (!$this->resolveRelatedModel()) {
            return $value;
        }

        return array_get($this->relatedModelInfo, 'url');
    }

    protected function resolveRelatedModel()
    {
        if ($this->type === 'custom-link') {
            return null;
        }
        $this->relatedModelInfo = menus_manager()->getObjectInfoByType($this->type, $this->related_id);

        return $this->relatedModelInfo;
    }

    /**
     * @var Collection
     */
    protected $allRelatedNodes;

    /**
     * @param int $menuId
     * @param array $nodeData
     * @param int $order
     * @param null $parentId
     * @return Model
     */
    public function updateMenuNode($menuId, array $nodeData, $order, $parentId = null)
    {
        $result = $this->updateOrCreate(['id' => (array_get($nodeData, 'id')) ? array_get($nodeData, 'id') : null], [
            'menu_id' => $menuId,
            'parent_id' => $parentId,
            'related_id' => array_get($nodeData, 'related_id') ?: null,
            'type' => array_get($nodeData, 'type'),
            'title' => array_get($nodeData, 'title') ? array_get($nodeData, 'title') : array_get($nodeData, 'model_title'),
            'icon_font' => array_get($nodeData, 'icon_font'),
            'css_class' => array_get($nodeData, 'css_class'),
            'target' => array_get($nodeData, 'target'),
            'url' => array_get($nodeData, 'url'),
            'order' => $order,
        ]);

        if(!$result) {
            return $result;
        }

        $children = array_get($nodeData, 'children', null);

        /**
         * Save the children
         */
        if($result && is_array($children)) {
            foreach ($children as $key => $child) {
                $this->updateMenuNode($menuId, $child, $key, $result->id);
            }
        }
        return $result;
    }

    /**
     * @param Menu|int $menuId
     * @param null|int $parentId
     * @return Collection|null
     */
    public function getMenuNodes($menuId, $parentId = null)
    {

        if (!$this->allRelatedNodes) {
            $this->allRelatedNodes = $this
                ->where('menu_id', $menuId)
                ->select(['id', 'menu_id', 'parent_id', 'related_id', 'type', 'url', 'title', 'icon_font', 'css_class', 'target'])
                ->orderBy('order', 'ASC')
                ->get();
        }

        $nodes = $this->allRelatedNodes->where('parent_id', $parentId);

        $result = [];

        foreach ($nodes as $node) {
            $node->model_title = $node->title;
            $node->children = $this->getMenuNodes($menuId, $node->id);
            $result[] = $node;
            /**
             * Reset related nodes when done
             */
            if ($node->id == $nodes->last()->id && $parentId === null) {
                $this->allRelatedNodes = null;
            }
        }

        return collect($result);
    }
}
