<?php

namespace crud;

use crud\Templates\Templates;

class Actions {
    function __construct() {
        $this->templates = new Templates();
        $this->crud      = new Crud();

        $method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : '';
        if ( $method === 'POST' && isset( $_POST['action'] ) ) {
            $this->handover_post( $_POST['action'] );
        } elseif ( $method === 'GET' && isset( $_GET['action'] ) ) {
            $this->handover_get( $_GET['action'] );
        }
    }

    /**
     * Handovers the action from GET request
     *
     * @param  [type] $action
     * @return void
     */
    public function handover_get( $action ) {
        switch ( $action ) {
            case 'db_migrate':
                Db::create_table();
                break;
            default:break;
        }
    }

    /**
     * Handovers the action from POST request
     *
     * @param  string $action
     * @return void
     */
    public function handover_post( $action ) {
        switch ( $action ) {
            case 'new_employee':
                $this->templates->echo_view( '/crud/new' );
                exit;
                break;
            case 'employee_list':
                $this->crud->retrieve();
                exit;
                break;
            case 'new_crud':
                $this->crud->create();
                break;
            case 'delete_crud':
                $this->crud->delete();
                break;
            case 'update_crud_template':
                $this->crud->update_template();
                break;
            case 'edit_employee':
                $this->crud->update();
            case 'load_single_row':
                $this->crud->load_single();
                break;
            default:break;
        }
    }
}