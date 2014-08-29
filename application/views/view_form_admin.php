<?php

if($content_view['form'] === TRUE && !isset($_SESSION['admin'])){
?>
<fieldset id="form_admin">
    <legend>Admin - form</legend>
    <table>
        <form method="POST">
            <tr>
                <td class="f_a_td_name"><strong>Имя:</strong></td>
                <td class="f_a_td_input"><input type="text" name="name_admin" required="required" class="input_admin"></td>
            </tr>
            <tr>
                <td class="f_a_td_name"><strong>Пароль:</strong></td>
                <td class="f_a_td_input"><input type="password" name="password_admin" required="required" class="input_admin"></td>
            </tr>
            <tr>
                <td colspan="2" class="f_a_td_sabmit"><input type="submit" name="sabmit_admin_autoriz" value="вход" class="sabmit_admin"></td>
            </tr>
        </form>
    </table>
</fieldset>
<?php
}elseif(isset($_SESSION['admin'])){
    require_once 'view_admin_pages.php';
}