<div class="rejApp">
    <h2 class="heading">Rejected Nurseries</h2>
    <div class="app-table">
        <!-- <table class="table table-striped table-hover">
            <tr>
             <th>First Name</th>
            <th>Last Name</th>
            <th>Points</th>
            </tr>
            <tr>
            <td>Jill</td>
            <td>Smith</td>
            <td>50</td>
            </tr>
        </table> -->
        <?php 
            require "connection.php";
            
            $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications
                    WHERE applications.application_id = nursery_details.nursery_id
                    AND applications.status = 'rejected'";
            include "./templates/showTableTemplateAssigned.php";
         ?>
        <!-- <img src="./img/sample.jpg"/> -->
    </div>
</div>
