<?php

namespace App\Interfaces;

interface BaseModelServiceInterface
{
    public function uploadPhoto($value, $field = 'photo_name');

    public function resource($data, $type = 'base');

    public function create(ApiRequestInterface $request);

    public function update(ApiRequestInterface $request, $id);

    public function changeStatus($id, $action = 'is_active');

    public function findById($id);

    public function findByUrl($url);

    public function findAll();

    public function findPaginateList();

    public function findActiveList();

    public function findDeActiveList();

    public function deleteById($id);

    public function deleteAll();

}
