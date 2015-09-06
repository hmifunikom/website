<?php

$serializer = new SuperClosure\Serializer;

return [

    'class' => HMIF\Modules\User\Entities\User::class,

    'initialize' => $serializer->serialize(function ($authority) {

        // Action aliases. For example:

        $authority->addAlias('moderate', ['read', 'update', 'delete']);

        // See the wiki of AuthorityController for details:
        // https://github.com/efficiently/authority-controller/wiki/Action-aliases

        // Define abilities for the passed in user here. For example:

        $user = auth()->guest() ? new HMIF\Modules\User\Entities\User : $authority->getCurrentUser();


        if($user->hasRole('anggota_hmif'))
        {
            $authority->allow('read', 'all');

            $authority->deny('manage', HMIF\Modules\Email\Entities\Email::class);

            $authority->deny('manage', HMIF\Modules\Event\Entities\Attendee::class);
            $authority->allow('read', HMIF\Modules\Event\Entities\Attendee::class);

            $authority->deny('manage', HMIF\Modules\Invoice\Entities\Invoice::class);

            $authority->allow('update', HMIF\Modules\Keanggotaan\Entities\Anggota::class, function($self, $anggota) {
                return $self->user()->userable->id_anggota == $anggota->id_anggota;
            });

            $authority->deny('manage', HMIF\Modules\User\Entities\User::class);
            $authority->deny('manage', HMIF\Modules\User\Entities\Role::class);
            $authority->deny('manage', HMIF\Modules\User\Entities\Permission::class);
        }

        if($user->exists)
        {
            $id_divisi = $user->userable->id_divisi;

            // Email | Humas, 4 Inti
            if($id_divisi == 6 || ($id_divisi >= 1 && $id_divisi <= 4))
            {
                $authority->allow('manage', HMIF\Modules\Email\Entities\Email::class);
            }

            // Invoice, Keanggotaan | ADM, 4 Inti
            if($id_divisi >= 1 && $id_divisi <= 5)
            {
                $authority->allow('manage', HMIF\Modules\Invoice\Entities\Invoice::class);
            }

            // Keanggotaan | ADM, Inti
            if($id_divisi == 5 || ($user->userable->divisi->id_penanggung_jawab == $user->userable->id_anggota))
            {
                $authority->allow('manage', HMIF\Modules\Keanggotaan\Entities\Anggota::class, function($self, $anggota) {
                    if($self->user()->userable->id_divisi >= 1 && $self->user()->userable->id_divisi <= 5) return true;
                    return $self->user()->userable->id_divisi == $anggota->id_divisi;
                });

                $authority->allow('coverStore', HMIF\Modules\Keanggotaan\Entities\Divisi::class, function($self, $divisi) {
                    if($self->user()->userable->id_divisi >= 1 && $self->user()->userable->id_divisi <= 5) return true;
                    return $self->user()->userable->id_divisi == $divisi->id_divisi;
                });
            }

            // User | Inti
            if($user->userable->divisi->id_penanggung_jawab == $user->userable->id_anggota)
            {
                $authority->allow('manage', HMIF\Modules\Event\Entities\Event::class);
                $authority->allow('manage', HMIF\Modules\Event\Entities\Ticket::class);
                $authority->allow('manage', HMIF\Modules\Event\Entities\Attendee::class);

                $authority->allow('manage', HMIF\Modules\Keanggotaan\Entities\Divisi::class);

                $authority->allow('manage', HMIF\Modules\User\Entities\User::class);
            }
        }

        $authority->allow('update', HMIF\Modules\User\Entities\User::class, function($self, $user) {
            return $self->user()->id_user->id_anggota == $user->id_user;
        });

        $authority->allow('update', HMIF\Modules\User\Entities\User::class, function($self, $user) {
            return $self->user()->id_user->id_anggota == $user->id_user;
        });

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


    })

];
