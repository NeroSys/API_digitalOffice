<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {


    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и менеджера новостей
        $admin = $auth->createRole('admin');
        $tenant = $auth->createRole('tenant'); //Арендаторы
        $lease = $auth->createRole('lease'); //Отдел аренды
        $marketing = $auth->createRole('marketing'); //Отдел маркетинга
        $maintenance = $auth->createRole('maintenance'); //Отдел эксплуатационной службы
        $accountant = $auth->createRole('accountant'); //Бухгалтерия

        // запишем их в БД
        $auth->add($admin);
        $auth->add($tenant);
        $auth->add($lease);
        $auth->add($marketing);
        $auth->add($maintenance);
        $auth->add($accountant);

        // Создаем разрешения. Доступ Арендатора
        $accessTenant = $auth->createPermission('accessTenant');
        $accessTenant->description = 'Доступ Арендатора';

        // Создаем разрешения. Доступ Отдел аренды
        $accessLease = $auth->createPermission('accessLease');
        $accessLease->description = 'Доступ Отдел аренды';

        // Создаем разрешения. Доступ Отдел маркетинга
        $accessMarketing = $auth->createPermission('accessMarketing');
        $accessMarketing->description = 'Доступ Отдел маркетинга';

        // Создаем разрешения. Доступ Отдел эксплуатационной службы
        $accessMaintenance = $auth->createPermission('accessMaintenance');
        $accessMaintenance->description = 'Доступ Отдел эксплуатационной службы';

        // Создаем разрешения. Доступ Бухгалтерия
        $accessAccountant = $auth->createPermission('accessAccountant');
        $accessAccountant->description = 'Доступ Бухгалтерия';


        // Создаем разрешения. Доступ Админ
        $accessAdministration = $auth->createPermission('accessAdministration');
        $accessAdministration->description = 'Доступ Админ';

        // Запишем эти разрешения в БД
        $auth->add($accessTenant);
        $auth->add($accessLease);
        $auth->add($accessMarketing);
        $auth->add($accessMaintenance);
        $auth->add($accessAccountant);
        $auth->add($accessAdministration);


        // Теперь добавим наследования.


        // Роли «Арендаторы» присваиваем разрешение «Доступ Арендатора»
        $auth->addChild($tenant,$accessTenant);

        // Контент менеджер наследует роль менеджера.
        $auth->addChild($lease, $accessLease);

        // Контент менеджер наследует роль менеджера.
        $auth->addChild($marketing, $accessMarketing);

        // Контент менеджер наследует роль менеджера.
        $auth->addChild($maintenance, $accessMaintenance);

        // Контент менеджер наследует роль менеджера.
        $auth->addChild($accountant, $accessAccountant);


        // админ наследует роль менеджера. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $accessTenant);

        // Еще админ имеет собственное разрешение - «Доступ к разделу админимтрирования»
        $auth->addChild($admin, $accessLease);

        // Еще админ имеет собственное разрешение - «Доступ к разделу админимтрирования»
        $auth->addChild($admin, $accessMarketing);

        // Еще админ имеет собственное разрешение - «Доступ к разделу админимтрирования»
        $auth->addChild($admin, $accessMaintenance);

        // Еще админ имеет собственное разрешение - «Доступ к разделу админимтрирования»
        $auth->addChild($admin, $accessAccountant);

        // Еще админ имеет собственное разрешение - «Доступ к разделу админимтрирования»
        $auth->addChild($admin, $accessAdministration);


        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль manager пользователю с ID 2
        $auth->assign($tenant, 2);

        // Назначаем роль manager пользователю с ID 2
        $auth->assign($lease, 3);

        // Назначаем роль manager пользователю с ID 2
        $auth->assign($marketing, 4);

        // Назначаем роль manager пользователю с ID 2
        $auth->assign($maintenance, 5);

        // Назначаем роль manager пользователю с ID 2
        $auth->assign($accountant, 6);

    }
}

