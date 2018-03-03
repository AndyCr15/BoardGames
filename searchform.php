<div class="row">
    <form method="post" id="search">

        <fieldset class="form-group col-md-6">

            <label>How Many Players:</label>
            <select class="form-control" name="players" id="players">
                <option value=0>Any</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>

            <script type="text/javascript">
                document.getElementById('players').value = "<?php echo $_POST['players'];?>";

            </script>

        </fieldset>

        <fieldset class="form-group col-md-6">

            <label>How Long A Game:</label>
            <select class="form-control" name="time" id="time">
                <option>Any</option>
                <option>Short</option>
                <option>Medium</option>
                <option>Long</option>
            </select>

            <script type="text/javascript">
                document.getElementById('time').value = "<?php echo $_POST['time'];?>";
                col - md - 6

            </script>

        </fieldset>

        <fieldset class="form-group col-md-6">

            <label>How Complicated:</label>
            <select class="form-control" name="difficulty" id="difficulty">
                <option>Any</option>
                <option>Simple</option>
                <option>Medium</option>
                <option>Complex</option>
            </select>

            <script type="text/javascript">
                document.getElementById('difficulty').value = "<?php echo $_POST['difficulty'];?>";

            </script>

        </fieldset>

        <div class="checkbox col-md-12">

            <label>

                <input type="checkbox" name="owned" id="ownded" value=1 <?php if(isset($_POST['owned'])) echo "checked='checked'"; ?>>Only Games I Own

            </label>

        </div>
        
        <div class="checkbox col-md-12">

            <label>

                <input type="checkbox" name="favs" id="favs" value=1 <?php if(isset($_POST['favs'])) echo "checked='checked'"; ?>>Only Favourites

            </label>

        </div>

        <fieldset class="form-group col-md-6">

            <input class="btn btn-success" type="submit" name="submit" value="Search">

        </fieldset>

        <fieldset class="form-group col-md-6">

            <a class="btn btn-danger" href="addgame.php">Add Game To Database</a>

        </fieldset>

    </form>
</div>
