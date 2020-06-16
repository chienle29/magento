<?php


namespace Cate\Demo\Api;

use Cate\Demo\Api\Data\MagenestInterface;


interface MagenestRepositoryInterface
{
    /**
     * @param int $id
     * @return \Cate\Demo\Api\Data\MagenestInterface
     */
    public function getById($id);

    /**
     * @param \Cate\Demo\Api\Data\MagenestInterface $magenest
     * @return \Cate\Demo\Api\Data\MagenestInterface
     */
    public function save(MagenestInterface $magenest);

    /**
     * @param \Cate\Demo\Api\Data\MagenestInterface $magenest
     * @return void
     */
    public function delete(MagenestInterface $magenest);
}
