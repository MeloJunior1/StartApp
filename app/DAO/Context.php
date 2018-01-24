<?php

namespace App\DAO;
use Illuminate\Database\Eloquent\Model;

trait Context {

    protected  $model;

    public function save(array $data) 
    {
        try
        {
            return $this->model->create($data);
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }   
    
    public function findOne($id)
    {
        try
        {
            return $this->model->findOrFail($id);
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    public function findAll()
    {
        try
        {
            return $this->model->all();
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try
        {
            return $this->model->findOrFail($id)->update($this->removeId($data));
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    protected function removeId(array $data)
    {
        try 
        {
            if(isset($data['id']))
            {
                if(!is_null($data['id']) || !empty($data['id'])) unset($data['id']);
            }
            
            return $data;
            
        }
        catch(Exception $e)
        {
            throw $e;
        }
        
    }
}