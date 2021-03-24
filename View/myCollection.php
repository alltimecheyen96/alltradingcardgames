<?php
require '../Controller/collectionController.php';
$collectionObject = new collectionController();
?>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/collectionStyle.css">
</head>
<body>

	<div id="homeHead">
		<?php include_once('header.php'); ?>
	</div>

<div class="section">
	<div class="searchContainer">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for card name.." title="Type in a name">
</div>
<table id="pager" class="table">
<thead>
	<tr>
    <th>Card number</th>
    <th>Name</th>
    <th>Set</th>
		<th>Rarity</th>
  </tr>
</thead>
<tbody>
<?php
	$result = $collectionObject->get_allCollection($_SESSION['id']);
	foreach ($result as $key)
	{?>
  <tr>
    <td><?php echo $key->CardNumber; ?></td>
    <td><?php echo $key->Name; ?></td>
    <td><?php $gameSet=  $collectionObject->get_GameSet($key->CardNumber);
		echo $gameSet["SetTypeName"]; ?></td>
		<td><?php $rarity = $collectionObject->get_Rarity($key->CardNumber);
		echo $rarity["RarityName"]; ?></td>
  </tr>
<?php } ?>
</tbody>
</table>

<div id="pageNavPosition" class="pager-nav"></div>
</div>

</body>

<script>

function Pager(tableName, itemsPerPage) {
    'use strict';

    this.tableName = tableName;
    this.itemsPerPage = itemsPerPage;
    this.currentPage = 1;
    this.pages = 0;
    this.inited = false;

    this.showRecords = function (from, to) {
        let rows = document.getElementById(tableName).rows;
        // i starts from 1 to skip table header row
        for (let i = 1; i < rows.length; i++) {
            if (i < from || i > to) {
                rows[i].style.display = 'none';
            } else {
                rows[i].style.display = '';
            }
        }
    };

    this.showPage = function (pageNumber) {
        if (!this.inited) {
            // Not initialized
            return;
        }

        let oldPageAnchor = document.getElementById('pg' + this.currentPage);
        oldPageAnchor.className = 'pg-normal';

        this.currentPage = pageNumber;
        let newPageAnchor = document.getElementById('pg' + this.currentPage);
        newPageAnchor.className = 'pg-selected';

        let from = (pageNumber - 1) * itemsPerPage + 1;
        let to = from + itemsPerPage - 1;
        this.showRecords(from, to);

        let pgNext = document.querySelector('.pg-next'),
            pgPrev = document.querySelector('.pg-prev');

        if (this.currentPage == this.pages) {
            pgNext.style.display = 'none';
        } else {
            pgNext.style.display = '';
        }

        if (this.currentPage === 1) {
            pgPrev.style.display = 'none';
        } else {
            pgPrev.style.display = '';
        }
    };

    this.prev = function () {
        if (this.currentPage > 1) {
            this.showPage(this.currentPage - 1);
        }
    };

    this.next = function () {
        if (this.currentPage < this.pages) {
            this.showPage(this.currentPage + 1);
        }
    };

    this.init = function () {
        let rows = document.getElementById(tableName).rows;
        let records = (rows.length - 1);

        this.pages = Math.ceil(records / itemsPerPage);
        this.inited = true;
    };

    this.showPageNav = function (pagerName, positionId) {
        if (!this.inited) {
            // Not initialized
            return;
        }

        let element = document.getElementById(positionId),
            pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal pg-prev">«</span>';

        for (let page = 1; page <= this.pages; page++) {
            pagerHtml += '<span id="pg' + page + '" class="pg-normal pg-next" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>';
        }

        pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">»</span>';

        element.innerHTML = pagerHtml;
    };
}

let pager = new Pager('pager', 10);
pager.init();
pager.showPageNav('pager', 'pageNavPosition');
pager.showPage(1);

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("pager");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
