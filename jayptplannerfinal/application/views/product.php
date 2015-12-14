<div align="center">

<br><br><br><br><br><br><br>
    <form action="<?php echo base_url();?>index.php/control/add_product" method="post">
        <table>
            <tr>
                <td>
                    Store Name:
                </td>
                <td>
                   <select name="b_id">
                    <?php foreach($data as $v){
                        ?>
                    <option value="<?php echo $v->b_id;?>"><?php echo $v->b_name;?></option>
                    <?php }
                    ?>
                   </select>
                </td>
            </tr>
            <tr>
                <td>
                    Product Name:
                </td>
                <td>
                    <input type="text" name="p_name">
                </td>
            </tr>
            <tr>
                <td>
                    Product Price:
                </td>
                <td>
                    <input type="text" name="p_price">
                </td>
            </tr>
        </table>
        <input type="submit" name="sub" value="Submit">
        <input type="reset" name="res" value="Reset">
    </form>
</div>

