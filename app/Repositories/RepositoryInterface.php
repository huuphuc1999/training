<?php
/**
 * Base repository 
 * 
 * PHP version 7
 *
 * @category  RepositoryInterface
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Repositories;
/**
 * A template for common problems
 * 
 * @category  RepositoryInterface
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
interface RepositoryInterface
{
    /**
     * Get all
     * 
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * 
     * @param $id use for query
     * 
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * 
     * @param array $attributes use for query
     * 
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * 
     * @param $id         use for query
     * @param array $attributes use for query
     * 
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     * 
     * @param $id use for query
     * 
     * @return mixed
     */
    public function delete($id);
}
