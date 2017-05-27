<?php

namespace Xcms\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Xcms\Base\Http\Controllers\SystemController;
use Xcms\Blog\Models\Category;
use Xcms\Blog\Models\Tag;
use Xcms\Menu\Models\Menu;
use Xcms\Menu\Models\MenuNode;
use Xcms\Page\Models\Page;

class MenuController extends SystemController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function (Request $request, $next) {

            menu()->setActiveItem('menus');

            $this->breadcrumbs
                ->addLink('系统设置')
                ->addLink('菜单列表', route('menus.index'));

            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return Menu::all()->toJson();
        }

        $this->setPageTitle('菜单管理');
        return view('menu::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::all();
        $categories = collect(Category::renderAsArray());
        $tags = Tag::all();

        return view('menu::create', compact('pages', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menuNode = new MenuNode();
        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->order = $request->order;
        $menu->save();

        $result = $menu->id;

        $menuStructure = json_decode($request->get('menu_structure'), true);

        foreach ($menuStructure as $order => $node){
            $menuNode->updateMenuNode($result, $node, $order);
        }

        return redirect()->route('menus.index')->with('success_msg', '添加菜单成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        $menuNode = new MenuNode();
        $pages = Page::all();
        $categories = collect(Category::renderAsArray());
        $tags = Tag::all();
        $menuStructure = json_encode($menuNode->getMenuNodes($id));

        return view('menu::edit', compact('menu', 'pages', 'categories', 'tags', 'menuStructure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menuNode = new MenuNode();
        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->order = $request->order;

        $menu->save();

        $result = $menu->id;

        $menuStructure = json_decode($request->get('menu_structure'), true);

        foreach ($menuStructure as $order => $node){
            $menuNode->updateMenuNode($result, $node, $order);
        }

        return redirect()->route('menus.index')->with('success_msg','编辑菜单成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        return response()->json(['code' => 200, 'message' => '删除菜单成功']);
    }
}
