<?php
/**
 * 菜单 service层
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-10-20
 * @version 1.0
 */
namespace Home\Service;
use Zlib\Model\BaseModel;

class MenuService extends BaseModel {

	/**
	 * 获取当前category下的全部子分类
	 */
	public function getMenu($category = Null)
	{
		$menu = array();
		$menu['top'] = $this->getTopMenu($category);
		$menu['sidebar'] = $this->getChildren($category);

		// dump($menu['sidebar']);
		return $menu;
	}

	/**
	 * 通过id获取最顶级分类
	 */
	public function getTopCategory($category)
	{
		return substr($category, 0, 1);
	}

	/**
	 * 获取二级分类id
	 */
	public function getTwoCateogry($category)
	{
		if (strlen($category) < 2)
			return (int)$category;
		return substr($category, 0, 2);
	}

	/**
	 * 获取某顶级下全部子级分类
	 * @param int cid 分类
	 */
	public function getChildren($category)
	{
		$top_category = $this->getTopCategory($category);
		$two_category = $this->getTwoCateogry($category);
		$three_category = $category;
		$is_first = strlen($three_category) == 1 ? True : False ;

		$rs = array();
		$menu = C('menu_category');
		$category_list = isset($menu[$top_category]) ? $menu[$top_category] : array_shift($menu);

		$i = 0;
		foreach ($category_list['children'] as $key => &$val) {
			if ($is_first && $i == 0) {
				$val['current'] = True;
			} else {
				$val['id'] == $two_category ? $val['current'] = True : $val['current'] = False;
			}

			foreach ($val['item'] as $k => &$v) {
				$v['id'] == $three_category ? $v['current'] = True : $v['current'] = False ;
			}

			++$i;
		}
		
		return $category_list;
	}

	/**
	 * 获取全部顶级分类
	 */
	public function getTopMenu($category)
	{
		$category = $this->getTopCategory($category);
		$top = array();
		$menu = C('menu_category');

		foreach ($menu as $val) {
			$top[$val['id']]['id'] = $val['id'];
			$top[$val['id']]['name'] = $val['name'];
			$top[$val['id']]['url'] = $val['url'];
			$top[$val['id']]['controller'] = $val['controller'];
			$top[$val['id']]['current'] = $category == $val['id'] ? True : False ;
		}

		return $top;
	}


}