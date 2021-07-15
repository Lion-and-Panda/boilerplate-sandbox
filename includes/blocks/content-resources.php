<?php
$resource_block_description = get_field('description');
$block_headline = get_field( 'block_headline' );

?>

<section id="resource-library" class="is-small section relative resource-library">
    <div class="container">

		<div id="loading" class="loading" ><div class="centered"><i class="fa fa-cog fa-spin"></i> Finding Resources ...</div></div>

<!--filter-->
	<div id="query-filter">
		<form method="post" id="filter-criteria">

                           <!--BLOCK HEADLINE-->
                <div class="columns is-multiline is-vcentered">
                <div class="column is-12 <?php if($invert) { ?> inverted <?php } ?>">
					<div><p style="opacity:.5;"><strong>RESOURCE CENTER</strong></p>

                    <?php if($block_headline) { ?>
                        <h2><?=$block_headline?></h2>
                    <?php } ?>

                     <?php if($resource_block_descriptio) { ?>
                        <div><?=$resource_block_description?></div>
                     <?php } ?>
                </div>
                    </div>
			</div>

				<div class="columns is-vcentered sorter">

                    <!--categories-->
                    <div class="column is-9">
                        <nav class="navbar-filter" role="filters" aria-label="filter navigation">
                        <div id="navbarBasicExample" class="navbar-menu">
                            <div class="navbar-start">
                                <a class="navbar-item libraryTypes selected" id="all" name="all" data-value="all">All</a>
                                <?php
                                $terms = get_terms('resource_category', array( 'orderby' => 'count', 'order' => 'DESC' ));
                                foreach($terms as $term){
                                    if($term->count > 0){ ?>
                                        <a class="navbar-item libraryTypes not-selected" id="<?= $term->slug; ?>" data-value="<?= $term->slug; ?>"><?= $term->name; ?></a></li>
                                    <?php }
                                }
                                ?>
                            </div>
                            </div>

                        <!--filter button-->
                            <a class="advanced-filter-trigger filterHidden left">Filter <i id="filterArrow" class="fas fa-angle-right "></i></a>

                        <!--reset button-->
				            <a id="reset" onClick="window.location.reload();" style="display: none;"><i class="fas fa-sync-alt"></i> Reset</a>

                        </nav>
                    </div>


					<div class="column is-3">
						<input class=" " type="search" placeholder="Type To Search" id="titleSearch" name="titleSearch"/>
					</div>
				</div>

			<div id="advanced-filter" class="hidden">
				<div class="columns is-vcentered is-multiline is-mobile" style="background-color: rgba(0,0,0,.025); padding: 15px; border-radius: 3px;">
					<div class="column is-5-desktop is-6-mobile">

                        <div class="filterHalf">
						<div class="filter-headline">
							<h4>Media Type</h4>
						</div>
						<div class="filter-options">
							<?php
							$terms = get_terms('type_group', array( 'orderby' => 'count', 'order' => 'DESC' ));
							foreach($terms as $term){
								if($term->count > 0){ ?>
									<div class="item clearfix">
									<input class="filter with-font typeFilter" type="checkbox" name="types[]" id="<?= $term->slug; ?>" value="<?= $term->slug; ?>">
									<label for="<?= $term->slug; ?>"><?= $term->name; ?></label>
									</div>
								<?php }
							}
							?>
						</div>

                        </div>

					</div>
					<div class="column is-5-desktop is-6-mobile">

                        <div class="filterHalf">
						<div class="filter-headline">
							<h4>Select Tags</h4>
						</div>
						<div class="filter-options" id="tagDiv">
								<!-- populated by JS -->
						</div>
                            </div>

					</div>

                    <div class="column is-2-desktop is-12-mobile">

                        <div class="filterHalf">
							<input name="tagSearch" id="tagSearch" class="right tagSearch" type="search" placeholder="Search Tags" value=""/>
                            </div>

					</div>

					<script type="text/javascript">
						jQuery(document).ready(function($){
							var timeoutID = null;

							$('#titleSearch').keyup(function(e) {
								clearTimeout(timeoutID);
								timeoutID = setTimeout(() => titleSearch(), 1500);
							});

							function titleSearch() {
								var strInput = $("#titleSearch").val();
								if(strInput.length > 2){
									submitSearch();
									// gtag('event', 'Search Resources', {
									// 	'event_category': 'Search Resources',
									// 	'event_label': strInput,
									// 	'value': strInput
									// });
								}
							}

							$('#tagSearch').on('input',function(e){
							//$(document).on('input', '#tagSearch', function () {
								clearTimeout(timeoutID);
								timeoutID = setTimeout(() => tagSearch(), 500);
							});

							function tagSearch() {
								var strInput = $("#tagSearch").val();
								//console.log(strInput);
								if(strInput.length > 2 || strInput == ""){
									//requery the tag box
									var searchFilter = $("#filter-criteria").serializeArray();
									searchFilter.push({name: "pullType", value: "updateTags"});
									//searchFilter.push({name: "tagValue", value: strInput});

									//grab the resource category, so we know what tags to apply
									$('.libraryTypes').each(function(){
										//console.log('in lib');
										if($(this).hasClass('selected')){
											searchFilter.push({name: "resource_categories[]", value: $(this).attr('data-value')});
											//console.log($(this).attr('data-value'));
										}
									});

									$.ajax ({
										type: "POST",
										url: "<?= get_template_directory_uri(); ?>/includes/content/theme/resource-library-process.php",
										data: searchFilter.valueOf(), //,
										cache: false,
										global: false,
										async: false,
										success: function(html) {
												$("#tagDiv").html(html).hide().fadeIn(1250);
												//$('#submit-filter').fadeOut(250); $('.equal-h').matchHeight();
										},
										error: function (e) {
                                                alert("An application error occured. Please contact your administrator. [Error code: ajax " + e + "]");
                                                console.log(e);

										}
									});

									searchFilter = $("#filter-criteria").serializeArray();
									searchFilter.push({name: "pullType", value: "updateSidebar"});

									//grab the resource category, so we know what tags to apply
									$('.libraryTypes').each(function(){
										//console.log('in lib');
										if($(this).hasClass('selected')){
											searchFilter.push({name: "resource_categories[]", value: $(this).attr('data-value')});
											//console.log($(this).attr('data-value'));
										}
									});

									$.ajax ({
										type: "POST",
										url: "<?= get_template_directory_uri(); ?>/includes/content/theme/resource-library-process.php",
										data: searchFilter.valueOf(), //,
										cache: false,
										global: false,
										async: false,
										success: function(html) {
												$("#sidebarFilter").empty().append(html).hide().fadeIn(1250);
												//$('#submit-filter').fadeOut(250); $('.equal-h').matchHeight();
										},
										error: function (e) {
                                                alert("An application error occured. Please contact your administrator. [Error code: ajax " + e + "]");
                                                console.log(e);
										}
									});
								}
							}

							$(document).on('click', '.tagFilter', function () {
								if($("#" + $(this).attr('id') + "-sidebar").attr('id')){
									$("#" + $(this).attr('id') + "-sidebar").remove();
								} else {
									$("#sidebarFilter").append('<li class="sidebarFilter" id="' + $(this).attr('id') + '-sidebar" data-count="' + $(this).attr('data-count') + '"><a>' + $("label[for='" + $(this).attr('id') + "']").text() + '</a></li>');
									//re-order li's
									$("#sidebarFilter li").sort(sort_li).appendTo('#sidebarFilter');
									function sort_li(a, b) {
										return ($(b).data('count')) > ($(a).data('count')) ? 1 : -1;
									}
								}
								submitSearch();
							});


							$(document).on('click', '.sidebarFilter', function () {
								var strTemp = "";
								strTemp = $(this).attr('id');
								strTemp = strTemp.replace("-sidebar","");
								$("#" + strTemp).prop('checked', true);
								$(this).remove();
								submitSearch();
							});

							$(document).on('click', '.typeFilter', function () {
								submitSearch();
								tagSearch();
							});

							$(document).on('click', '.groupFilter', function () {
								submitSearch();
								tagSearch();
							});

							$(document).on('click', '.advanced-filter-trigger', function () {
								if($(this).hasClass("filterHidden")){
									$("#advanced-filter").addClass("is-visible");
									$("#try-advanced-filter").removeClass("is-visible");
									$("#advanced-filter").removeClass("hidden");
									$("#filterArrow").addClass("fa-angle-down");
									$("#filterArrow").removeClass("fa-angle-right");
									$(this).removeClass("filterHidden");
								} else {
									$("#advanced-filter").removeClass("is-visible");
									$("#advanced-filter").addClass("hidden");
									$("#try-advanced-filter").removeClass("is-visible");
									$("#filterArrow").removeClass("fa-angle-down");
									$("#filterArrow").addClass("fa-angle-right");
									$(this).addClass("filterHidden");
								}
							});

							$('.libraryTypes').on('click', function(event){
								event.preventDefault();
								if($(this).attr('id') == 'all'){
									$('#order').removeClass("selected");
									$('#order').addClass('not-selected');
									$('#all').addClass("selected");
									$('#all').removeClass('not-selected');

									//reset other filters too
									$('.groupFilter').each(function () {
										$(this).attr('checked', false);
									});

									$('.typeFilter').each(function () {
										$(this).attr('checked', false);
									});

									$('.tagFilter').each(function () {
										$(this).attr('checked', false);
									});
								} else {
									//only really does this the first time it's clicked
									if ($("#advanced-filter").is(':not(.is-visible)')) {
										$("#try-advanced-filter").addClass("is-visible");
									}
									$("#filterArrow").addClass("fa-angle-down");
									$("#filterArrow").removeClass("fa-angle-right");

									//if only one non "All" button clicked, don't unselect it
									var libraryTypes = document.getElementsByClassName('libraryTypes');
									var selectedCount = 0;
									$.each( libraryTypes, function( key, value ) {
										if($('#' + value.id).hasClass('selected')){
											selectedCount++;
										}
									});

									if($(this).hasClass('not-selected')){
										$(this).removeClass('not-selected');
										$(this).addClass("selected");
									} else {
										if(selectedCount > 1){
											$(this).addClass('not-selected');
											$(this).removeClass("selected");
										}
									}
									$('#all').removeClass("selected");
									$('#all').addClass('not-selected');
								}

								submitSearch();
								tagSearch();
							});

							function submitSearch() {
								$.when(
									$('#loading').addClass('is-active'),
									$('#query-results').html(''),
									$('#loading').fadeIn(1000),
									console.log("loading")
								).done( function () {
									//get page array
									var searchFilter = $('#filter-criteria').serializeArray();

									//get all selected links
									$('.libraryTypes').each(function () {
										if ($(this).hasClass('selected')) {
											searchFilter.push({
												name: "resource_categories[]",
												value: $(this).attr('data-value')
											});
										}
									});

									searchFilter.push({name: "pullType", value: "results"});

									$('#reset').fadeIn(1250);
									$.ajax({
										type: "POST",
										url: "<?= get_template_directory_uri(); ?>/includes/content/theme/resource-library-process.php",
										data: searchFilter.valueOf(), //,
										cache: false,
										global: false,
										async: false,
										success: function (html) {
											$('#loading').removeClass('is-active');
											$('#loading').fadeOut(1000);
											$("#query-results").html(html).hide().fadeIn(1250);

										},
										error: function (e) {
                                            alert("An application error occured. Please contact your administrator. [Error code: ajax " + e + "]");
                                            console.log(e);

										}
									});
								});
								return false;
							}

							//populate page, on initial load
							submitSearch();
							tagSearch();


						});
					</script>
				</div>
			</div>
		</form>
	</div>

        <!--results-->
		<div class="section is-small relative" style="padding-top: 20px;"> <!-- Container for sidebar tags -->
			<div id="query-results"  class="p-t-50 p-b-50">
			</div>
		</div>


    </div>
</section>
