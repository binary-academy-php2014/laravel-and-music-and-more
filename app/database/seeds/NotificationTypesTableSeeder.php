<?php

use \Karma\Entities\NotificationType;

class NotificationTypesTableSeeder extends Seeder
{
    public function run()
    {
        NotificationType::all()->delete();

        NotificationType::create(['title' => NotificationType::TITLE_FRIEND_NEW_REQUEST]);

        $this->command->info('NotificationType table seeded!');
    }
} 