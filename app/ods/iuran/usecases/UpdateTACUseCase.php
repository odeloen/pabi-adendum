<?php

namespace App\Ods\Iuran\UseCases;

use App\Ods\Core\Requests\UseCaseResponse;

class UpdateTACUseCase 
{
    private $tacDirectory = 'Ods/iuran/tac/';

    public function execute($tac, $tacFile){
        if ($tac->path != null && file_exists(storage_path('app/public/'.$tac->path))){
            unlink(storage_path('app/public/'.$tac->path));
        }        

        $tacFilePath = $tacFile->store('public/'.$this->tacDirectory);

        $fileName = $tacFile->getClientOriginalName();
        // $tac->name = $fileName;

        $tempArray = explode('/', $tacFilePath);
        $filePath = $this->tacDirectory.end($tempArray);
        // dd($filePath);

        $tac->path = $filePath;

        try {
            $tac->save();    
        } catch (\Throwable $th) {
            if ($tac->receipt_path != null && file_exists(storage_path('app/public/'.$tac->receipt_path))){
                unlink(storage_path('app/public/'.$tac->receipt_path));
            }
            $response = UseCaseResponse::createErrorResponse('Gagal menggunggah syarat dan ketentuan');
            return $response;
        }

        $message = 'Berhasil menggunggah syarat dan ketentuan';
        $response = UseCaseResponse::createMessageResponse($message);

        return $response;
    }
}
