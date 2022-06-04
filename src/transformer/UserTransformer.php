<?php

namespace Khanguyennfq\CarForRent\transformer;

use Khanguyennfq\CarForRent\model\UserModel;

class UserTransformer
{
    /**
     * @param UserModel $user
     * @return array
     */
    public function toArray(UserModel $user): array
    {
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'fullName' => $user->getCustomerName(),
        ];
    }
}
