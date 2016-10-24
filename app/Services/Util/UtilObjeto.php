<?php

namespace CentralCondo\Services\Util;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class UtilObjeto
{

    protected $filesystem;

    protected $storage;

    public function __construct(Filesystem $filesystem, Storage $storage)
    {
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function upload($file, $path, $validator)
    {
        $rules = array('file' => 'required|mimes:' . $validator);
        $validator = Validator::make(array('file' => $file), $rules);
        if ($validator->passes()) {

            $nameImage = md5($file->getFilename());
            $extension = $file->getClientOriginalExtension();
            $this->storage->put($path . $nameImage, $this->filesystem->get($file));

            $result = [
                'name' => $file->getClientOriginalName(),
                'file' => $nameImage,
                'extension' => $extension
            ];

            return $result;
        }
        return false;
    }

    public function paginate($dados)
    {
        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = 15;
        $currentPageSearchResults = $dados->slice($currentPage * $perPage, $perPage)->all();
        $dados  = new LengthAwarePaginator($currentPageSearchResults, count($dados), $perPage);

        return $dados;
    }

}