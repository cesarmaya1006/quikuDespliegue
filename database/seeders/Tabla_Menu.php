<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            // Menus padre
            1['nombre' =>  'Inicio', 'menu_id' => '0', 'url' =>  'admin/index', 'orden' => '1', 'icono' =>  'fas fa-home'],
            2['nombre' =>  'Sistema', 'menu_id' => '0', 'url' =>  '#', 'orden' => '6', 'icono' =>  'fas fa-tools'],
            3['nombre' =>  'Menús', 'menu_id' => '2', 'url' =>  'admin/menu-index', 'orden' => '1', 'icono' =>  'fas fa-list-ul'],
            4['nombre' =>  'Roles Usuarios', 'menu_id' => '2', 'url' =>  'admin/rol-index', 'orden' => '2', 'icono' =>  'fas fa-user-tag'],
            5['nombre' =>  'Menú - Roles', 'menu_id' => '2', 'url' =>  'admin/_menus_rol', 'orden' => '3', 'icono' =>  'fas fa-chalkboard-teacher'],
            6['nombre' =>  'Permisos', 'menu_id' => '2', 'url' =>  'admin/permiso-index', 'orden' => '4', 'icono' =>  'fas fa-lock'],
            7['nombre' =>  'Permisos -Rol', 'menu_id' => '2', 'url' =>  'admin/_permiso-rol', 'orden' => '5', 'icono' =>  'fas fa-user-lock'],
            8['nombre' =>  'Usuarios', 'menu_id' => '2', 'url' =>  'admin/usuario-index', 'orden' => '6', 'icono' =>  'fas fa-user-friends'],
            9['nombre' =>  'Gestionar', 'menu_id' => '0', 'url' =>  '#', 'orden' => '7', 'icono' =>  'fas fa-chalkboard-teacher'],
            10['nombre' =>  'Listado PQR', 'menu_id' => '9', 'url' =>  'usuario/listado', 'orden' => '1', 'icono' =>  'far fa-list-alt'],
            11['nombre' =>  'Generar PQR', 'menu_id' => '9', 'url' =>  'usuario/generar', 'orden' => '3', 'icono' =>  'fas fa-plus-square'],
            12['nombre' =>  'Otras opciones', 'menu_id' => '0', 'url' =>  '#', 'orden' => '8', 'icono' =>  'fas fa-question-circle'],
            13['nombre' =>  'Consulte nuestas políticas de datos', 'menu_id' => '12', 'url' =>  'usuario/consulta-politicas', 'orden' => '1', 'icono' =>  'fas fa-question-circle'],
            14['nombre' =>  'Ayuda', 'menu_id' => '12', 'url' =>  'usuario/ayuda', 'orden' => '2', 'icono' =>  'fas fa-question-circle'],
            15['nombre' =>  'Actualizar datos', 'menu_id' => '12', 'url' =>  'usuario/actualizar-datos', 'orden' => '3', 'icono' =>  'fas fa-edit'],
            16['nombre' =>  'Cambiar contraseña', 'menu_id' => '12', 'url' =>  'usuario/cambiar-password', 'orden' => '4', 'icono' =>  'fas fa-key'],
            17['nombre' =>  'Listado PQR', 'menu_id' => '33', 'url' =>  'funcionario/listado', 'orden' => '1', 'icono' =>  'fas fa-question-circle'],
            18['nombre' =>  'Crear usuario asistido', 'menu_id' => '34', 'url' =>  'funcionario/crear-usuario', 'orden' => '1', 'icono' =>  'fas fa-user-plus'],
            19['nombre' =>  'Actualizar datos', 'menu_id' => '34', 'url' =>  'funcionario/actualizar-datos', 'orden' => '2', 'icono' =>  'fas fa-edit'],
            20['nombre' =>  'Cambiar contraseña', 'menu_id' => '34', 'url' =>  'funcionario/cambiar-password', 'orden' => '3', 'icono' =>  'fas fa-key'],
            21['nombre' =>  'Listado usuarios', 'menu_id' => '33', 'url' =>  'funcionario/usuarios-listado', 'orden' => '2', 'icono' =>  'fas fa-list-ul'],
            22['nombre' =>  'Parametros', 'menu_id' => '0', 'url' =>  '#', 'orden' => '9', 'icono' =>  'fas fa-cogs'],
            23['nombre' =>  'Categorias', 'menu_id' => '22', 'url' =>  'admin/categorias-index', 'orden' => '1', 'icono' =>  'fas fa-list-ul'],
            24['nombre' =>  'Productos', 'menu_id' => '22', 'url' =>  'admin/productos-index', 'orden' => '2', 'icono' =>  'fas fa-list-ul'],
            25['nombre' =>  'Marcas', 'menu_id' => '22', 'url' =>  'admin/marcas-index', 'orden' => '3', 'icono' =>  'fas fa-list-ul'],
            26['nombre' =>  'Referencias', 'menu_id' => '22', 'url' =>  'admin/referencias-index', 'orden' => '4', 'icono' =>  'fas fa-list-ul'],
            27['nombre' =>  'Wiku', 'menu_id' => '0', 'url' =>  'funcionario/wiku-index', 'orden' => '4', 'icono' =>  'fas fa-list-ul'],
            28['nombre' =>  'Tutelas', 'menu_id' => '0', 'url' =>  '#', 'orden' => '3', 'icono' =>  'fas fa-chalkboard-teacher'],
            29['nombre' =>  'Registro', 'menu_id' => '28', 'url' =>  'admin/registro', 'orden' => '1', 'icono' =>  'fas fa-plus-square'],
            30['nombre' =>  'Listado', 'menu_id' => '28', 'url' =>  'admin/listado', 'orden' => '2', 'icono' =>  'far fa-list-alt'],
            31['nombre' =>  'Gestión', 'menu_id' => '28', 'url' =>  'admin/gestion', 'orden' => '3', 'icono' =>  'fas fa-grip-horizontal'],
            32['nombre' =>  'Consulta', 'menu_id' => '28', 'url' =>  'funcionario/consulta', 'orden' => '4', 'icono' =>  'fas fa-search'],
            33['nombre' =>  'PQR', 'menu_id' => '0', 'url' =>  '#', 'orden' => '2', 'icono' =>  'Elija un Icono'],
            34['nombre' =>  'Conf Cuenta Usuario', 'menu_id' => '0', 'url' =>  '#', 'orden' => '5', 'icono' =>  'fas fa-user-cog'],
            35['nombre' =>  'Gestionar PQR', 'menu_id' => '33', 'url' =>  'funcionario/gestion_pqr', 'orden' => '2', 'icono' =>  'fas fa-grip-horizontal'],
            36['nombre' =>  'Analítica', 'menu_id' => '0', 'url' =>  'analitica', 'orden' => '9', 'icono' =>  'fas fa-grip-horizontal'],
            37['nombre' =>  'Wiku Parametros', 'menu_id' => '0', 'url' =>  'admin/funcionario/wiku/index', 'orden' => '9', 'icono' =>  'fas fa-grip-horizontal'],
            //----------------------------------------------------------------------------------------------------------------------

        ];

        foreach ($menus as $menu) {
            DB::table('menu')->insert([
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'menu_id' => $menu['menu_id'],
                'url' => $menu['url'],
                'orden' => $menu['orden'],
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
