<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <!-- Draw a calculator -->
        <div id="main" style="width: 200px; margin: 0 auto; margin-top: 15px;">
            <h4>Calculator</h4><br/>
            <form method="GET" action="calc.php"> 
                <table style="width: 200px; border: 2px solid grey;">
                    <tr>
                        <td colspan="4"><?php echo"0"; ?></td>
                        <td><button class="waves-effect waves-light red btn" style="width: 100%;">cls</button></td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="7"></td>
                        <td><input type="radio" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="8"></td>
                        <td><input type="radio" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="9"></td>
                        <td><input type="radio" name="op" class="waves-effect waves-light indigo btn" style="width: 100%;" value="+"></td>
                        <td><input type="radio" name="op" class="waves-effect waves-light indigo btn" style="width: 100%;" value="√"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="4"></td>
                        <td><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="5"></td>
                        <td><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="6"></td>
                        <td><input type="submit" name="op" class="waves-effect waves-light indigo btn" style="width: 100%;" value="-"></td>
                        <td><input type="submit" name="op" class="waves-effect waves-light indigo btn" style="width: 100%;" value="^"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="1"></td>
                        <td><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="2"></td>
                        <td><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="3"></td>
                        <td><input type="submit" name="op" class="waves-effect waves-light indigo btn" style="width: 100%;" value="*"></td>
                        <td rowspan="2"><input type="submit" name="op" class="waves-effect waves-light green btn" style="width: 100%; height: 100px; display: inline-block;" value="="></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;"><input type="submit" name="num" class="waves-effect waves-light blue btn" style="width: 100%;" value="0"></td>
                        <td><input type="submit" name="op" class="waves-effect waves-light indigo btn" style="width: 100%;" value="/"></td>
                    </tr>
                </table>
            </form>
        </div>

        <!-- echo "".$num1."+".$num2."=".$num1+$num2.""; -->
        
    </body>
</html>