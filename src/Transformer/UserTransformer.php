<?php

namespace Khanguyennfq\CarForRent\Transformer;

use Khanguyennfq\CarForRent\Model\UserModel;

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
