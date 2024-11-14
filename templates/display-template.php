<h1>Data Entries</h1>
<table class="widefat fixed" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Category</th>
            <th>Group</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'edi_data';
        $results = $wpdb->get_results("SELECT * FROM $table_name");

        if ($results) {
            foreach ($results as $row) {
                echo "<tr>
                        <td>{$row->id}</td>
                        <td>{$row->code}</td>
                        <td>{$row->category}</td>
                        <td>{$row->group}</td>
                        <td>{$row->name}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        ?>
    </tbody>
</table>