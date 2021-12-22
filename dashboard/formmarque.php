<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bluur {
            filter: blur(1.5rem);
        }

        div {
            z-index: 1;
        }

        form {
            display: none;
            z-index: 99;
            width: 50%;
            margin: auto;
            border: 1px solid #000;
            text-align: center;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, facere animi blanditiis at incidunt quo veritatis dignissimos commodi consequatur ad, voluptatum tenetur minus laborum quibusdam repellendus excepturi! Rerum reprehenderit quis aspernatur quae soluta magnam sint facilis.*</p>
        <button href="">
            Add New Produit
        </button>
    </div>
    <form action="" id="form-marque">
        <h2>Add Produit</h2>
        <input type="text">
        <input type="submit">
    </form>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $('button').click(function() {
            $(this).parent().addClass('bluur')
            $('#form-marque').show();
        })
    </script>
</body>

</html>