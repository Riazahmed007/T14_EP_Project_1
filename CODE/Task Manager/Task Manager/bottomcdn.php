<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php
$del=rand(10,400);
?>

<script>
  function confirmDelete(deleteUrl) {
    var userInput = prompt("Please type '<?php echo $del; ?>' to confirm deletion:");

    if (userInput === "<?php echo $del; ?>") {
      window.location.href = deleteUrl;
    }
  }

  function confirmUserDelete(deleteUrl) {
    var userInput = prompt("Please type '<?php echo $del; ?>' to confirm deletion:");

    if (userInput === "<?php echo $del; ?>") {
      window.location.href = deleteUrl;
    }
  }
</script>
<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const contentArea = document.querySelector('.col.py-3');
        sidebar.classList.toggle('collapsed');
        contentArea.classList.toggle('col-md-9');
    }
</script>
