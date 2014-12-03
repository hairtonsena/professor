<table class="table table-striped">
    <thead>
        <tr>
            <th>Cidades</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cidade as $cd) {
            ?>
            <tr>
                <td>
                    <?php echo $cd->nome_cidade ?>
                </td>
                <td> <input type="checkbox" /> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>