<?php
class Database_Connection{

    public static function connect(){
        $DBusername = 'root';
        $DBpassword = '';
        $DBname     = 'acf_learning';
        $DBhost     = 'localhost';

        return mysqli_connect( $DBhost,$DBusername,$DBpassword,$DBname );
    }

    public static function fetch_data( $table,$where = '',$fields = '*'){

        $connect = self::connect();

        $query = "SELECT {$fields} FROM {$table}";
        if( !empty( $where ) ){
            $WHERE  = " WHERE {$where}";
            $query .= $WHERE;
        }
        $result = mysqli_query( $connect,$query );
        mysqli_close( $connect );
        return $result;
    }

    public static function insert( $table,$fields,$value ){
        $connect = self::connect();
        $fields  = implode( ",",$fields );
        $value   = implode( ",",$value );
        $query   = "INSERT INTO {$table}($fields)VALUES( {$value} )";
        mysqli_query( $connect,$query ) or die( mysqli_error( $connect ) );
        $last_id = mysqli_insert_id( $connect );
        mysqli_close( $connect );
        return $last_id;
    }

    public static function update( $table,$value,$where ){
        $connect = self::connect();

        foreach( $value as $field_key => $field_value ){
            $fields[] = $field_key . "=" . $field_value;
        }

        foreach( $where as $field_key => $field_value ){
            $condition[] = $field_key . "=" . $field_value;
        }
    
        $values     = implode( ",",$fields );
        $conditions = implode( " AND ",$condition );

        if( empty( $conditions ) || empty( $values ) ){
            return false;
        }
        
        $query  = "UPDATE {$table} SET {$values} WHERE {$conditions}";
        $result = mysqli_query( $connect,$query ) or die( mysqli_error( $connect ) );
        mysqli_close( $connect );
        return $result;
    }
    public static function delete($table, $where)
    {
        $connect = self::connect();

        foreach ($where as $field_key => $field_value) {
            $condition[] = $field_key . "=" . $field_value;
        }
        $conditions  = implode(" AND ", $condition);

        if (empty($conditions)) {
            return false;
        }

        $query  = "DELETE FROM {$table} WHERE {$conditions}";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        mysqli_close($connect);
        return $result;
    }
}

?>