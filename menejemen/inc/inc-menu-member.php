<?php
include 'inc-db.php';
session_start();
//--tampilkan menu==> MENU PARENT UNTUK MEMBER
$sqlmenu1="SELECT menu_id, menu_name, menu_parent from ref_menu where menu_parent=0 AND menu_id=13";
// $sqlmenu1 = "SELECT ref_menu.menu_id, menu_name, menu_parent, menu_url FROM ref_level_menu
//             LEFT JOIN ref_menu ON ref_level_menu.menu_id=ref_menu.menu_id
//             LEFT JOIN ref_level ON ref_level_menu.level_id=ref_level.level_id
//             WHERE level_name='member' ";

$resultmenu1=mysql_query($sqlmenu1);
//$run=mysql_query($sqlmenu1);

while($datamenu1=mysql_fetch_array($resultmenu1)){
    $varMenuId=$datamenu1['menu_id'];
    $varMenuName=$datamenu1['menu_name'];
    $varMenuParent=$datamenu1['menu_parent'];?>
    
    <li class="panel">
    <a href="#" data-toggle="collapse" data-target=".collapse-<?php echo $varMenuId;?>">
        <i class="icon-tasks"> </i>
        <?php echo $varMenuName ?>
        <span class="pull-right">
            <i class="icon-angle-left"></i>
        </span>
    </a>
        <?php
        //--tonton menu_id berdasarkan levelnya apa
        $sqlmenu2="select menu_id from ref_level_menu where level_id=4";
        $resultmenu2=mysql_query($sqlmenu2); ?>
        <ul class="collapse-<?php echo $varMenuId; ?> collapse">
        <?php
        while($datamenu2=mysql_fetch_array($resultmenu2)){ 
            $varMenuId2=$datamenu2['menu_id'];
            //--tampilan daftar menunya
            $sqlmenu3="select menu_id, menu_name, menu_url from ref_menu where menu_id='".$varMenuId2."'";
            $sqlmenu3=$sqlmenu3 . " and menu_parent='".$varMenuId."'";

        
            $resultmenu3=mysql_query($sqlmenu3);
            while($datamenu3=mysql_fetch_array($resultmenu3)){
                $varMenuName3=$datamenu3['menu_name'];
                $varMenuUrl3=$datamenu3['menu_url'];?>               
                    
                    <li class=""><a href="<?php echo $varMenuUrl3?>"><?php echo $varMenuName3 ?></a></li>
            		<?php
           			} // tutup while datamenu3
        		} // tutup while datamenu 2
        	?>
    	</ul> 
   	</li>
	<?php
}// tutup while datamenu 1
?>