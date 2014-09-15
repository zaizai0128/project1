<?php
/**
 * 作者站首页
 *
 * @author 	songmw<songmingwei@kongzhong.com>
 * @date 	2014-09-10
 * @version 1.0
 */
namespace Home\Controller;
use Common\Controller\BaseController;
use Zlib\Api as Zapi;

class IndexController extends BaseController {

	/**
	 * 作者站首页
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 新建作品
	 */
	public function createNewBook()
	{
		$book_class = Zapi\BookClass::getInstance()->getAllClassForJson();

		$this->assign(array(
			'book_class' => $book_class,
		));
		$this->display();
	}

	/**
	 * 提交新建作品
	 */
	public function doCreateNewBook()
	{
		if (IS_POST) {
			
			$data = I();
			$book_service = D('Book', 'Service');
			$state = $book_service->checkBook($data);

			if ($state['code'] < 0)
				$this->error($state['msg']);

			$data['bk_author'] = session('author.author_name');
			$data['bk_author_id'] = $this->user_id;
			$data['bk_poster_id'] = $this->user_id;

			$book_apply_obj = D('BookApply');
			$book_id = $book_apply_obj->doAdd($data);

			if ($book_id) {
				
				// 添加作品后的动作，更新书籍的权限
				$data['bk_id'] = $book_id;
				$tag['data'] = $data;
				$tag['ac'] = 'after_add';
				tag('book', $tag);

				$this->success('添加成功等待审核', ZU('bookApply/book', 'ZL_AUTHOR_DOMAIN', array('bk_apply_id'=>$book_id)));
			} else {

				$this->error('添加失败');
			}
		}
	}

	/**
	 * 作者必读
	 */
	public function read()
	{
		$info = file_get_contents('http://www.zhulang.com/w_author_privilige_info.php');
		$this->show($info);
	}

	/**
	 * 新建作品说明
	 */
	public function createNewBookHelp()
	{
		$content = file_get_contents('http://www.zhulang.com/htmpage/zpschuan.html');
		$this->show($content);
	}

}