<?php /* Template Name: Page Tracking */ ?>

<?php get_header(); ?>
<style>
  canvas {
        background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/world-big.jpg');
        background-size: 100% 100%;
        border-radius: 300px;
  }

  #blocCountry {
    position: absolute;
    font-size: 25px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    width: 100%;
    color: #25aae1;
    z-index: 1000;
    bottom: 50px;
    background-color: rgba(255, 255, 255, 0.9);
  }

  #country {
    display: inline-block; padding: 20px 40px; min-height: 30px; 
  }

  #globo {
    position: relative;
    width: 400px;
  }
  a.btn {
      width: 300px;
      display: inline-block;
      text-decoration: none;
  }
</style>

<div class="container" style="margin-bottom:150px;">
    <div class="row">
    <div class="col-md-6" style="margin-top:60px;">
        
    <h3 class="text-center">Select your tracking destination</h3><br />
    <p class="text-center"><a type="button" class="btn btn-outline-primary btn-lg" target="_blank" href="https://worldcargopacific.logixboard.com" style="font-size:18px !important">WCP PORTAL for Papeete only</a></p><br />
    <p class="text-center"><a type="button" class="btn btn-outline-primary btn-lg" target="_blank" href="https://wcp.worldlinkadvance.com/" style="font-size:18 !important">WCP TRACKING for all</a></p>
        </div>
        <div class="col-md-6">
            <div id="globo">
            <div id="blocCountry"><div id="country"></div></div>
            </div>
        </div>

</div>

    </div>

  <!-- your content here... -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/d3.v3.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/queue.v1.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/topojson.v1.min.js"></script>
  <script>
  var width = 400,
      height = 400;
  var projection = d3.geo.orthographic()
      .translate([width / 2, height / 2])
      .scale(width / 2 )
      .clipAngle(90)
      .precision(0.6);
  var canvas = d3.select("#globo").append("canvas")
      .attr("width", width)
      .attr("height", height);
  var c = canvas.node().getContext("2d");
  
  var path = d3.geo.path()
      .projection(projection)
      .context(c);
  var title = d3.select("#country");

  queue()
      .defer(d3.json, "<?php echo get_stylesheet_directory_uri(); ?>/js/world-110m.json")
      .defer(d3.tsv, "<?php echo get_stylesheet_directory_uri(); ?>/js/world-110m-country-names.tsv")
      .await(ready);
  
  
  function ready(error, world, names) {
    if (error) throw error;
  
    var globe = {type: "Sphere"},
        land = topojson.feature(world, world.objects.land),
        countries = topojson.feature(world, world.objects.countries).features,
        borders = topojson.mesh(world, world.objects.countries, function(a, b) { return a !== b; }),
        i = -1,
        n = countries.length;
    countries = countries.filter(function(d) {
      return names.some(function(n) {
        if (d.id == n.id) return d.name = n.name;
      });
    }).sort(function(a, b) {
      return a.name.localeCompare(b.name);
    });
    console.log(countries);
  
    function vai(destinazione){
    //projection.scale(50);
    result = destinazione.split('[');
    result = result[1];
    result = result.replace("[", "");
    i = result.replace("]", "");
    d3.transition()
      .tween("rotate", function() {
        title.text(countries[i % n].name);
  
        var p = d3.geo.centroid(countries[i]),
            r = d3.interpolate(projection.rotate(), [-p[0], -p[1]]);
  
        return function(t) {
          projection.rotate(r(t));
          c.clearRect(0, 0, width, height);
          c.fillStyle = "#ccc", c.beginPath(), path(land), c.fill();
          c.fillStyle = "#25aae1", c.beginPath(), path(countries[i]), c.fill();
          c.strokeStyle = "#fff", c.lineWidth = .5, c.beginPath(), path(borders), c.stroke();
          /*c.strokeStyle = "#25aae1", c.lineWidth = 1, c.beginPath(), path(globe), c.stroke();*/
        };
      })
  
    }
  
    var destinazioni=[
      "United States[164]",
        "New Zealand[112]",
        "Canada[27]",
        "Australia[7]",
        "France[54]",
        "China[31]",
        "Brazil[20]",
        "Korea[84]",
        "South Africa[140]",
        "Chile[30]",
        "Japan[79]",
      "fine[5000]"];
    /*console.log(destinazioni);*/
  
  
  var dest = 0;
  var ndest = destinazioni.length;                   //  set your counter to 1
  
  function myLoop () {
     setTimeout(function () {
        vai(destinazioni[dest]);
        /*console.log(dest);*/
        if (dest < ndest-2) {
          dest++;
        }else{
          dest=0;
        }
        myLoop();
     }, 3000)
  }
  
  myLoop();
  
  }
  d3.select(self.frameElement).style("height", height + "px");
  </script>



</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>