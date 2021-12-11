<!--this is a demo view-->
<?php
    require_once(ROOT_DIR.'/templates/partials/header.php');
?>

<div class="container">
    <?php
        if (isset($_SESSION['response_message']) && !empty($_SESSION['response_message']))
        {
            echo '<p id="alert"><label id="'.$_SESSION["response_message"][1].'">'.$_SESSION["response_message"][0].'</label></p>';
            unset($_SESSION['response_message']);
        }
    ?>
    <input type="hidden" id="add-route" value="<?php echo ROUTE['create'] ?>"/>
    <input type="hidden" id="edit-route" value="<?php echo ROUTE['update'] ?>"/>
    <input type="hidden" id="delete-route" value="<?php echo ROUTE['delete'] ?>"/>
    <form method="post" action="">
        <input type="hidden" name="id"/>
        <table class="add-edit-table">
            <thead>
                <tr>
                    <th colspan="2" class="opt-label">Add New</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Player</td>
                    <td>&nbsp;&nbsp;&nbsp;<input type="text" name="player_name" autocomplete="off"/></td>
                </tr>
                <tr>
                    <td>Sport</td>
                    <td>&nbsp;&nbsp;&nbsp;
                        <select name="sport_name">
                            <option value="" selected disabled>Choose</option>
                            <option value="Auto Racing">Auto Racing</option>
                            <option value="Badminton">Badminton</option>
                            <option value="Baseball">Baseball</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Boxing">Boxing</option>
                            <option value="Cricket">Cricket</option>
                            <option value="Football">Football</option>
                            <option value="Golf">Golf</option>
                            <option value="Hockey">Hockey</option>
                            <option value="Mixed Martial Arts">Mixed Martial Arts</option>
                            <option value="Soccer">Soccer</option>
                            <option value="Table Tennis">Table Tennis</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Volleyball">Volleyball</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Total Earings</td>
                    <td>
                        $&nbsp;<input type="text" name="total_usd" class="float-number-only" autocomplete="off"/>&nbsp;M
                    </td>
                </tr>
                <tr>
                    <td>On-The-Field Earings</td>
                    <td>
                        $&nbsp;<input type="text" name="on_usd" class="float-number-only" autocomplete="off"/>&nbsp;M
                    </td>
                </tr>
                <tr>
                    <td>Off-The-Field Earings</td>
                    <td>
                        $&nbsp;<input type="text" name="off_usd" class="float-number-only" autocomplete="off"/>&nbsp;M
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td align="right">
                        &nbsp;&nbsp;&nbsp;<button type="reset">Clear</button>
                        &nbsp;<button type="submit" class="btn-label">Save</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php set_csrf() ?>
    </form>
    <br/><br/>
    <table class="list-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Sport</th>
                <th>Total<br/>Earnings</th>
                <th>On-The-Field<br/>Earnings</th>
                <th>Off-The-Field<br/>Earnings</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($data) > 0)
                {
                    foreach($data as $key=>$rank)
                    {
                        echo '<tr>';
                        echo '<td>'.($key+1).'</td>';
                        echo '<td>'.$rank->player_name.'</td>';
                        echo '<td>'.$rank->sport_name.'</td>';
                        echo '<td>$'.$rank->total_usd.'M</td>';
                        echo '<td>$'.$rank->on_usd.'M</td>';
                        echo '<td>$'.$rank->off_usd.'M</td>';
                        echo '<td><button class="edit-btn" data-obj="'.htmlspecialchars(json_encode($rank), ENT_QUOTES, "UTF-8").'">Edit</button>';
                        echo '&nbsp;&nbsp;<button class="del-btn" data-id="'.$rank->id.'">X</button></td>';
                        echo '</tr>';
                    }
                }
                else
                {
                    echo '<tr><td colspan="7" style="text-align: center!important;"><i>No data found</i></td></tr>';
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    require_once(ROOT_DIR.'/templates/partials/footer.php');
?>