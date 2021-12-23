<tr>
    <td><?php echo $order->id ?></td>
    <td><?php echo $order->datecommande ?></td>
    <td><?php
        if ($order->etat) {
            echo 'Traiter';
        } else {
            echo "En Cours";
        }
        ?>
    </td>