<?php
namespace app\admin\controller;

use think\Db;

/**
 * ORM : 对象关系映射
 * 一张表为一个类（一个模型）
 * 一行数据为一个对象
 * 一个字段为一个属性
 */

class Article extends Base
{
    // 文章列表
    public function index()
    {
        // 获取文章
        $articleList = db('article')->order('id', 'desc')->paginate(10);

        // 分配到试图
        $this->assign('articleList', $articleList);

        return $this->fetch();
    }

    // 文章添加页面
    public function add()
    {
        if (Request()->isPost()) {
            // 组装数据
            $data = [
                'title'       => input('title/s'),
                'author'      => input('author/s'),
                'cid'         => input('cid/d'),
                'image'       => input('image/s'),
                'url'         => input('url/s'),
                'create_time' => time(),
            ];

            // 验证数据
            $valiResult = $this->validate($data, 'Article');
            if ($valiResult !== true) {
                return $this->error($valiResult);
            }

            // 开启事务 [注意：使用事务的时候，不能使用助手函数，要使用 Db 类静态方法]
            Db::startTrans();
            try
            {
                // 添加数据
                $article_id = Db::table('article')->insertGetId($data);
                if (empty($article_id)) {
                    // 回滚事务
                    Db::rollback();
                    return $this->error('文章添加失败');
                }

                $content = input('content/s');

                // 组装文章详情数据
                $descData = [
                    'article_id' => $article_id,
                    'content'    => $content,
                ];

                // 添加文章详情
                $row = Db::table('article_desc')->insert($descData);
                if (empty($row)) {
                    // 回滚事务
                    Db::rollback();
                    return $this->error('文章添加失败');
                }

                // 提交事务
                Db::commit();
                return $this->success('文章添加成功', url('admin/article/index'));

            } catch (Exception $e) {
                // 回滚事务
                Db::rollback();
            }

        }

        // 找出文章分类数据
        $cateData = db('article_cate')->select();

        // 分配到视图
        $this->assign('cateData', $cateData);

        return $this->fetch();
    }

    // 文章修改
    public function edit()
    {
        if (!input('?id')) {
            return $this->error('参数错误！');
        }

        // 接收id
        $id = input('id/d');

        //查询文章信息
        $article = Db::table('article')->find($id);
        if (empty($article)) {
            $this->error('文章不存在');
        }

        if (Request()->isPost()) {
            // 组装数据
            $data = [
                'title'  => input('title/s'),
                'author' => input('author/s'),
                'cid'    => input('cid/d'),
                'image'  => input('image/s'),
                'url'    => input('url/s'),
                'id'     => $id,
            ];

            // 验证数据
            $valiResult = $this->validate($data, 'Article');

            if ($valiResult !== true) {
                return $this->error($valiResult);
            }

            // 开启事务 [注意：使用事务的时候，不能使用助手函数，要使用 Db 类静态方法]
            Db::startTrans();
            try {
                $status = false;
                // 修改数据
                $row = Db::table('article')->update($data);
                if (!empty($row)) {
                    $status = true;
                }

                // 修改内容
                $descRow = Db::table('article_desc')->update([
                    'content'    => input('content/s'),
                    'article_id' => $id,
                ]);

                if (!empty($descRow)) {
                    $status = true;
                }

                if ($status === false) {
                    // 回滚事务
                    Db::rollback();
                    return $this->error('文章修改失败');
                }

                // 查询修改后的文章图片
                $articleOld = Db::table('article')->find($id);

                // 如果有修改文章图片 再删除图片
                if (!empty($article['image']) && $article['image'] != $articleOld['image'] && file_exists($article['image'])) {
                    unlink($article['image']);
                }

                // 提交事务
                Db::commit();
                return $this->success('修改成功', url('admin/article/index'));

            } catch (Exception $e) {
                // 回滚事务
                Db::rollback();
            }
        }

        // 找出文章的详细信息
        $article['desc'] = db('article_desc')->where('article_id', $id)->value('content');

        // 分配到视图
        $this->assign('article', $article);

        // 找出文章分类数据
        $cateData = db('article_cate')->select();

        // 分配到视图
        $this->assign('cateData', $cateData);

        return $this->fetch();
    }

    // 文章删除
    public function del()
    {
        if (!input('?id')) {
            return $this->error('参数错误');
        }

        $id = input('id/d');

        $article = db('article')->find($id);

        if (empty($article)) {
            return $this->error('该文章不存在');
        }

        // 开启事务 [注意：使用事务的时候，不能使用助手函数，要使用 Db 类静态方法]
        Db::startTrans();
        try
        {
            // 注意删除数据的先后顺序，否则会出现外键约束的错误
            // 删除文章详情
            $descRow = Db::table('article_desc')->delete($id);

            if (empty($descRow)) {
                Db::rollback();
                return $this->error('删除失败');
            }

            // 删除文章信息
            $row = Db::table('article')->delete($id);

            if (empty($row)) {
                Db::rollback();
                return $this->error('删除失败');
            }

            // 删除文章图片文件
            if (!empty($article['image']) && file_exists($article['image'])) {
                unlink($article['image']);
            }

            // 提交事务
            Db::commit();
            return $this->success('删除成功', url('admin/article/index'));

        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
        }

    }

}
