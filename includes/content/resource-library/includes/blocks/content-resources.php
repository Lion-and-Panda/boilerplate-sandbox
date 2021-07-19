<?php
$resource_block_description = get_field('description');
$block_headline = get_field( 'block_headline' );
?>

<!--defer magnific.js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js" integrity="sha512-+m6t3R87+6LdtYiCzRhC5+E0l4VQ9qIT1H9+t1wmHkMJvvUQNI5MKKb7b08WL4Kgp9K0IBgHDSLCRJk05cFUYg==" crossorigin="anonymous"></script>

<!-- Resource Library Block -->

<section id="resource-library" class="is-small section relative resource-library">
    <div class="container">


    <!--filter-->
    	<div id="query-filter">
    		<form method="post" id="filter-criteria">

          <!--BLOCK HEADLINE-->
          <div class="columns is-multiline is-vcentered">
            <div class="column is-12 <?php if($invert) { ?> inverted <?php } ?>">
    					<div>
                <?php if($block_headline) { ?>
                  <h2 class="headingLarge"><?=$block_headline?></h2>
                <?php } ?>

                <?php if($resource_block_description) { ?>
                  <div><?=$resource_block_description?></div>
                <?php } ?>
              </div>
            </div>
    			</div>

          <!--sorter/filter system-->
          <div class="columns is-vcentered is-multiline sorter">

            <!--categories filter-->
            <div class="column is-9">
              <nav class="navbar-filter" aria-label="filter navigation">
                <div id="categoryfilter">
                    <button class="libraryTypes selected" id="all" name="all" data-value="all">All</button>

                    <?php
                    $terms = get_terms('resource_category', array( 'orderby' => 'count', 'order' => 'DESC' ));
                    foreach($terms as $term){
                        if($term->count > 0){ ?>
                            <button class="libraryTypes not-selected" id="<?= $term->slug; ?>" tabindex="0" data-value="<?= $term->slug; ?>"><?= $term->name; ?></button>
                        <?php }
                      }
                      ?>
                  </div>
                </nav>
              </div>

              <!--search resource library-->
    					<div class="column is-3">
                <label for="titleSearch" class="visually-hidden">Search Resource Library</label>
    						<input class=" " type="search" placeholder="Search Resources" id="titleSearch" name="titleSearch"/>
              </div>

            <!--filter and reset buttons-->
            <div class="column is-12">
                <!--filter dropdown button-->
                <button class="advanced-filter-trigger filterHidden left" aria-haspopup="true" aria-expanded="false" name="data" type="button" onclick="return false;">Filter <i id="filterArrow" class="fas fa-angle-right "></i></button>
                <!--reset button-->
                <button id="reset" onClick="window.location.reload();" style="display: none;" ><i class="fas fa-sync-alt"></i> Reset</button>
            </div>
          </div>

            <!--filter dropdown area-->
            <div id="advanced-filter" class="hidden" aria-hidden="true" aria-label="advanced filter area open" tabindex="-1">

              <!--close button-->
              <div class="text-right">
                <button class="advanced-filter-close filterHidden" aria-label="close filters" onclick="return false;"><i class="fas fa-times"></i></button>
              </div>

              <div class="columns is-multiline is-mobile">

                <div class="column is-6-desktop is-12-mobile">

                  <!--filter by type-->
                  <div class="filterHalf">
                    <fieldset>
                      <legend>Filter By Media Type</legend>

                    <div class="filter-options">
                      <?php
                      $terms = get_terms('type_group', array( 'orderby' => 'count', 'order' => 'DESC' ));
                      foreach($terms as $term){
                        if($term->count > 0){ ?>
                          <div class="item clearfix">
                            <input class="filter with-font typeFilter" type="checkbox" tabindex="0" name="types[]" id="<?= $term->slug; ?>" value="<?= $term->slug; ?>">
                            <label for="<?= $term->slug; ?>"><?= $term->name; ?></label>
                          </div>
                        <?php }
                      } ?>
                    </div>

                  </fieldset>
                  </div>
                </div>

                <!--filter by tag-->
                <div class="column is-6-desktop is-12-mobile">
                  <div class="filterHalf relative">
                    <!--give screenreader and keyboard-only users ability to skip past long tag listing-->
                    <a class="skip-link screen-reader-text" tabindex="0" href="#query-results"><?php esc_html_e( 'Skip tag list' ); ?> > </a>
                    <fieldset>
                      <legend>Filter By Tags</legend>
                      <label for="tagSearch" class="visually-hidden">Search Resource Library by tags</label>
                      <input name="tagSearch" id="tagSearch" class="tagSearch" type="search" placeholder="Search Tags" value=""/>
                    <div class="filter-options" id="tagDiv">
                      <!-- populated by JS -->
                    </div>
                  </fieldset>
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
    										url: "<?= get_template_directory_uri(); ?>/includes/content/resource-library/resource-library-process.php",
    										data: searchFilter.valueOf(), //,
    										cache: false,
    										global: false,
    										async: false,
    										success: function(html) {
    												$("#tagDiv").html(html).hide().fadeIn(1250);
    												//$('#submit-filter').fadeOut(250); $('.equal-h').matchHeight();
    										},
    										error: function (e) {
                            alert("this is where the error comes from. An application error occured. Please contact your administrator. [Error code: ajax " + e + "]");
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
    										url: "<?= get_template_directory_uri(); ?>/includes/content/resource-library/resource-library-process.php",
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
    									$("#advanced-filter").toggleClass("is-visible");
    									$("#advanced-filter").toggleClass("hidden");
                      $("#advanced-filter").attr("aria-hidden", function (i, attr) {
                          return attr == "true" ? "false" : "true";
                      });
    									$("#filterArrow").toggleClass("fa-angle-down");
    									$("#filterArrow").toggleClass("fa-angle-right");
    									$(this).toggleClass("filterHidden");
                      $(this).attr("aria-expanded", function (i, attr) {
                          return attr == "true" ? "false" : "true";
                      });
                      $("#advanced-filter").focus();
    								} else {
    									$("#advanced-filter").toggleClass("is-visible");
    									$("#advanced-filter").toggleClass("hidden");
                      $("#advanced-filter").attr("aria-hidden", function (i, attr) {
                          return attr == "true" ? "false" : "true";
                      });
    									$("#filterArrow").toggleClass("fa-angle-down");
    									$("#filterArrow").toggleClass("fa-angle-right");
    									$(this).toggleClass("filterHidden");
                      $(this).attr("aria-expanded", function (i, attr) {
                          return attr == "true" ? "false" : "true";
                      });
                      $(this).focus();
    								}
    							});

                  $(document).on('click', '.advanced-filter-close', function () {
                    $(this).closest("#advanced-filter").removeClass("is-visible"),
                    $("#advanced-filter").removeClass("is-visible");
                    $("#advanced-filter").addClass("hidden");
                    $("#advanced-filter").attr('aria-hidden', 'true');
                    $('.advanced-filter-trigger').attr('aria-expanded', 'false');
                    $("#filterArrow").removeClass("fa-angle-down");
                    $("#filterArrow").addClass("fa-angle-right");
    							});


                  //make category search activate with mouse click
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
                      $('#loading').html('<h3><i class="fas fa-circle-notch fa-spin"></i> Loading Resources</h3>'),
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
    										url: "<?= get_template_directory_uri(); ?>/includes/content/resource-library/resource-library-process.php",
    										data: searchFilter.valueOf(), //,
    										cache: false,
    										global: false,
    										async: false,
    										success: function (html) {
    											$('#loading').removeClass('is-active');
                          $('#loading').html(''),
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

                //add enter key listener to all click actions for accessibility
                    $(".typeFilter").keyup(function(event) {
                          if (event.keyCode === 13) {
                              $(this).click();
                          }
                      });
    					</script>

    				</div>
    			</div>
    		</form>
    	</div>

        <!--results-->
		<div class="section is-small relative" style="padding-top: 20px;"> <!-- Container for sidebar tags -->
      <div id="loading" class="centered" aria-live="assertive">
        <!--contents created by js. Accessible live announcment-->
      </div>

			<div id="query-results"  class="p-t-50 p-b-50">
        <!--populated by js-->
      </div>
		</div>

  </div>
</section>
