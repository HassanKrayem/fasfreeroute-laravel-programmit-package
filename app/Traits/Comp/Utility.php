<?php

namespace Programmit\Traits\Comp;

trait Utility
{
    public function getHtmlTemplates()
    {
        return [
            'required_field' => '<i class="fa fa-circle-o text-warning ml-2"></i>',
            'optional_field' => '<i class="fa fa-circle-o text-info ml-2"></i>',
        ];
    }

    public function compIsMultipleSelection($requestInput)
    {
        $data = $requestInput;
        $multipleDeleteRequest = true;

        if(gettype($requestInput) == 'string')
        {
            $multipleDeleteRequest = false;
            $data = [
                $requestInput,
            ];
        }

        return [
            'multiple' => $multipleDeleteRequest,
            'data' => $data
        ];
    }
}