<?php

namespace crud;

use crud\Templates\Templates;

class Crud {
    const cols = [
        'first_name'    => [
            'title' => 'First name',
            'type'  => 'text',
        ],
        'last_name'     => [
            'title' => 'Last name',
            'type'  => 'text',
        ],
        'job_title'     => [
            'title' => 'Job title',
            'type'  => 'text',
        ],
        'date_of_birth' => [
            'title' => 'Date of birth',
            'type'  => 'date',
        ],
        'work_shift'    => [
            'title'   => 'Work shift',
            'type'    => 'select',
            'options' => [
                'night' => 'Night',
                'day'   => 'Day',
            ],
        ],
        'mobile'        => [
            'title' => 'Mobile',
            'type'  => 'text',
        ],
        'email'         => [
            'title' => 'Email',
            'type'  => 'email',
        ],
        'address'       => [
            'title' => 'Address',
            'type'  => 'text',
        ],
        'joined'        => [
            'title' => 'Joined',
            'type'  => 'date',
        ],
    ];
    function __construct() {
        $this->db        = Db::db();
        $this->templates = new Templates();
    }

    public function create() {
        $data = [];
        $db   = $this->db;

        // Assigns Data from POST
        foreach ( self::cols as $col => $schema ) {
            if ( isset( $_POST[$col] ) ) {
                $data[$col] = $_POST[$col];
            }
        }

        $ccl = $this->ccl();

        $p = $db->prepare(
            "INSERT INTO employee ({$ccl['result']}) VALUES ({$ccl['commas']})"
        );

        if ( $p ) {
            $p->bind_param( 'sssssssss',
                $data['first_name'],
                $data['last_name'],
                $data['job_title'],
                $data['date_of_birth'],
                $data['work_shift'],
                $data['mobile'],
                $data['email'],
                $data['address'],
                $data['joined']
            );

            $p->execute();
        }

    }

    public function update() {
        $data = [];
        $db   = $this->db;
        $id   = isset( $_POST['id'] ) ? $_POST['id'] : 0;

        // Assigns Data from POST
        foreach ( self::cols as $col => $schema ) {
            if ( isset( $_POST[$col] ) ) {
                $data[$col] = $_POST[$col];
            }
        }

        $ccl = $this->ccl();

        // Prepare DB
        $p = $db->prepare(
            "UPDATE employee SET {$ccl['qus']} WHERE id=?"
        );

        $p->bind_param( 'sssssssssi',
            $data['first_name'],
            $data['last_name'],
            $data['job_title'],
            $data['date_of_birth'],
            $data['work_shift'],
            $data['mobile'],
            $data['email'],
            $data['address'],
            $data['joined'],
            $id
        );

        $p->execute();
    }

    public function update_template() {
        $id = isset( $_POST['id'] ) ? $_POST['id'] : 0;

        $p = $this->db->prepare(
            "SELECT * FROM employee WHERE id=? LIMIT 1"
        );
        $p->bind_param( 'd', $id );
        $p->execute();

        $row = $p->get_result()->fetch_object();

        ob_start();
        include __DIR__ . "./Templates/views/crud/edit.php";
        echo ob_get_clean();
        exit;
    }

    public function delete() {
        $id = isset( $_POST['id'] ) ? $_POST['id'] : 0;
        $p  = $this->db->prepare(
            "DELETE FROM employee WHERE id=?"
        );
        $p->bind_param( 'd', $id );
        $p->execute();
    }

    public function retrieve() {
        $db = $this->db;

        $r = $db->query(
            "SELECT * FROM employee"
        );

        ob_start();
        include __DIR__ . "/Templates/views/crud/list.php";
        echo ob_get_clean();
    }

    public function view() {
        $id = isset( $_POST['id'] ) ? $_POST['id'] : 0;

        $p = $this->db->prepare(
            "SELECT * FROM employee WHERE id=? LIMIT 1"
        );
        $p->bind_param( 'd', $id );
        $p->execute();

        $row = $p->get_result()->fetch_object();

        ob_start();
        $this->templates->view( '/crud/new' );
        echo ob_get_clean();
        exit;
    }

    public function load_single() {
        $offset = isset( $_POST['offset'] ) ? $_POST['offset'] : 0;

        if ( $offset == 0 ) {
            $r = $this->db->query(
                "SELECT * FROM employee LIMIT 1 OFFSET 0"
            );

            $row = $r;

            ob_start();
            include __DIR__ . "./Templates/views/crud/list.php";
            echo ob_get_clean();
            exit;
        }

        $p = $this->db->prepare(
            "SELECT * FROM employee LIMIT 1 OFFSET ?"
        );
        $p->bind_param( 'd', $offset );
        $p->execute();
        $row = $p->get_result()->fetch_object();
        if ( ! $row ) {
            exit;
        }
        $offset++;
        $single = "<tr data-id='{$row->id}' data-offset='{$offset}'>";

        foreach ( self::cols as $col => $val ) {
            $single .= "<td>{$row->$col}</td>";
        }

        $single .= "<td>
                    <i class='single-crud-edit fas fa-user-edit'></i>
                    <i class='single-crud-delete far fa-trash-alt'></i>
                    </td></tr>";

        echo $single;
        exit;
    }

    public function ccl() {
        $result = '';
        $commas = '';
        $qus    = '';

        foreach ( self::cols as $key => $value ) {
            $result .= "{$key}, ";
            $commas .= "?, ";
            $qus .= "{$key}=?, ";
        }

        $result = substr( $result, 0, strlen( $result ) - 2 );
        $commas = substr( $commas, 0, strlen( $commas ) - 2 );
        $qus    = substr( $qus, 0, strlen( $qus ) - 2 );

        return [
            'result' => $result,
            'commas' => $commas,
            'qus'    => $qus,
        ];
    }

}