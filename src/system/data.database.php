<?php

namespace SimpleConMan;
use PDO;

/**
 * Handles database connection and CRUD.
 *
 * The Database class takes care of all database needs throughout the system. It is written using PDO and prepared
 * statements, making it fairly safe from malicious code.
 */
class Database
{

    /**
     * Writes new data to a table.
     *
     * Inserts new data to a specified table in the database. The data is delivered as an array with the keys
     * corresponding to fields and the values to... well, values.
     *
     * @param string $table Which table in the database the data should be written to.
     * @param array $data The data to be written.
     * @param bool $return_query If set to true, returns the query without executing it.
     */
    public function create($table, $data, $return_query = false)
    {
        if ($table == '') {
            $out = 'Error: No table selected.';
        } elseif ($data == '') {
            $out = 'Error: No data to insert.';
        } else {
            $table = Settings::db('prefix') . $table;
            $sql = 'INSERT INTO `' . $table . '` (' . implode(', ', array_keys($data)) . ') VALUES (:' . implode(', :', array_keys($data)) . ')';

            if ($return_query) {
                $out = $sql;
            } else {
                $con = $this->connect();
                $stmt = $con->prepare($sql);
                foreach ($data as $key => $value) {
                    $stmt->bindParam(':' . $key, $$key);
                    $$key = $value;
                }

                try {
                    $stmt->execute();
                    $out = true;
                } catch(PDOException $error) {
                    $out = $error->getMessage();
                }

                $con = null;
            }
        }
        return $out;
    }

    /**
     * Reads data from a table.
     *
     * This function reads data from the specified table, using the information in the query array to assemble a complete
     * query. In short, it mostly operates the same way as `create()`. If no LIMIT is defined in the query, the LIMIT is
     * set to 1000.
     *
     * @param string $table Which table in the database the data should be read from.
     * @param array $data An array with all the parts of the query.
     * @param bool $return_query If set to true, returns the query without executing it.
     */
    public function read($table, $query = '', $return_query = false)
    {
        if ($table == '') {
            $out = 'Error: No table selected.';
        } else {
            $table = Settings::db('prefix') . $table;
            if (is_array($query)) {
                $sql_select = (isset($query['select']) ? '`' . $query['select'] . '`' : '*');
                $sql_param['limit'] = (isset($query['limit']) ? $query['limit'] : 1000);
                if (isset($query['where'])) {
                    foreach ($query['where'] as $key => $value) {
                        $sql_param[$key] = $value;
                        $sql_where[$key] = $key . ' = :' . $key;
                    }

                    $sql_where = ' WHERE ' . implode(' ' . (isset($query['join']) ? $query['join'] : 'OR') . ' ', $sql_where);
                } else {
                    $sql_where = '';
                }
            } else {
                $query = '';
                $sql_select = '*';
                $sql_where = '';
            }

            $sql = 'SELECT ' . $sql_select . ' FROM `' . $table . '`' . $sql_where . ' LIMIT :limit';

            if ($return_query) {
                $out = $sql;
            } else {
                $con = $this->connect();
                $stmt = $con->prepare($sql);
                if (isset($query['where'])) {
                    foreach ($sql_param as $key => $value) {
                        $stmt->bindParam(':' . $key, $$key);
                        $$key = $value;
                    }
                }
                $stmt->execute();
                $out = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $con = null;
            }
        }
        return $out;
    }

    public function update($table, $where, $data, $returnquery = false)
    {
    }

    public function delete($table, $where, $returnquery = false)
    {
    }

    /**
     * This function connects to the database.
     *
     * The main database handler. Since it's PDO I'll eventually make sure that it's possible to choose what type of
     * database to use. Since all connections are handled from within this class there is no need to make it public.
     *
     * @return object Returns a PDO database object, connected to the specified database.
     */
    private function connect()
    {
        try {
            $con = new PDO('mysql:host=' . Settings::db('host') . ';dbname=' . Settings::db('dbname'), Settings::db('username'), Settings::db('password'));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $out = $con;
        } catch(PDOException $error) {
            $out = $error->getMessage();
        }
        return $out;
    }

}
