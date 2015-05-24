<?php

return [

    'class' => 'HMIF\Modules\User\Entities\User',

    'initialize' => function ($authority) {

        // Action aliases. For example:

        $authority->addAlias('moderate', ['read', 'update', 'delete']);

        // See the wiki of AuthorityController for details:
        // https://github.com/efficiently/authority-controller/wiki/Action-aliases

        // Define abilities for the passed in user here. For example:

        $user = auth()->guest() ? new HMIF\Modules\User\Entities\User : $authority->getCurrentUser();

        $authority->allow('update', 'HMIF\Modules\User\Entities\User', function($self, $user) {
            return $self->user()->id_user->id_anggota == $user->id_user;
        });

        if($user->hasRole('anggota_hmif'))
        {
            $authority->allow('read', 'all');

            $authority->allow('update', 'HMIF\Modules\Keanggotaan\Entities\Anggota', function($self, $anggota) {
                return $self->user()->userable->id_anggota == $anggota->id_anggota;
            });

            $authority->allow('manage', 'HMIF\Modules\Event\Entities\Attendee');

            $authority->deny('manage', 'HMIF\Modules\User\Entities\Role');
            $authority->deny('manage', 'HMIF\Modules\User\Entities\Permission');
        }

        if ($user->hasRole('admin'))
        {
            $authority->allow('manage', 'all');
        }
        // The first argument to `allow` is the action you are giving the user
        // permission to do.
        // If you pass 'manage' it will apply to every action. Other common actions
        // here are 'read', 'create', 'update' and 'destroy'.
        //
        // The second argument is the resource the user can perform the action on.
        // If you pass 'all' it will apply to every resource. Otherwise pass a Eloquent
        // class name of the resource.
        //
        // The third argument is an optional anonymous function (Closure) to further filter the
        // objects.
        // For example, here the user can only update available products.
        //
        //  $authority->allow('update', 'Product', function($self, $product) {
        //      return $product->available === true;
        //  });
        //
        // See the wiki of AuthorityController for details:
        // https://github.com/efficiently/authority-controller/wiki/Defining-Authority-rules
        //
        // Loop through each of the users permissions, and create rules:

        foreach ($user->permissions as $perm)
        {
            if ($perm->type == 'allow')
            {
                $authority->allow($perm->action, $perm->resource);
            }
            else
            {
                $authority->deny($perm->action, $perm->resource);
            }
        }


    }

];
