<?php

namespace Xcms\Menu\Support;

use Illuminate\Support\Collection;
use Xcms\Acl\Models\Admin;

class DashboardMenu
{
    /**
     * Get all registered links from package
     * @var array
     */
    protected $links = [];

    /**
     * Get all activated items
     * @var array
     */
    protected $active = [];

    /**
     * @var Admin
     */
    protected $loggedInUser;

    /**
     * @var string
     */
    protected $builtHtml;

    /**
     * @param Admin $admin
     * @internal param Admin $user
     */
    public function setUser(Admin $admin)
    {
        $this->loggedInUser = $admin;
    }

    /**
     * Add link
     * @param array $options
     * @return $this
     */
    public function registerItem(array $options)
    {
        $defaultOptions = [
            'heading' => null,
            'title' => null,
            'icon' => null,
            'link' => null,
            'children' => collect([]),
            'permissions' => [],
        ];

        foreach ($options as $key =>$option){

            if(isset($option['children'])){
                foreach ($option['children'] as $k => $child){
                    $option['children'][$k] = array_merge($defaultOptions, $child);
                }
                $option['children'] = collect($option['children']);
            }

            $item = array_merge($defaultOptions, $option);

            $this->links[$key] = $item;
        }

        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function removeItem($id)
    {
        array_forget($this->links, $id);

        return $this;
    }

    /**
     * Rearrange links
     * @return Collection
     */
    protected function rearrangeLinks()
    {
        $links = collect($this->links);
        return $links;
    }

    /**
     * Get activated items
     * @param $active
     */
    protected function setActiveItems($active)
    {
        foreach ($this->links as $key => $value) {
            $this->active[] = $active;
            foreach ($value['children'] as $k => $v){
                if ($k == $active) {
                    $this->active[] = $key;
                }
            }
        }
    }

    /**
     * Render the menu
     * @param null|string $active
     * @return mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function setActiveItem($active = null)
    {
        $this->setActiveItems($active);

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $links = $this->rearrangeLinks();
        return view('menu::partials.menu', [
            'isChildren' => false,
            'links' => $links,
            'level' => 0,
            'active' => $this->active,
            'loggedInUser' => $this->loggedInUser
        ])->render();
    }
}
