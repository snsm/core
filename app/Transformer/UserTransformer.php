<?php

namespace App\Transformer;


/**
 * Class LessonTransformer
 * @package App\Transformer
 */
class UserTransformer extends Transformer
{

    /**
     * @param $lesson
     * @return array
     */
    public function transform($user){
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'mobile' => $user['mobile'],
            'status' => $user['status'],
        ];
    }

}