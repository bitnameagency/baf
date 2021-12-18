<title>{{ $title }}</title>
<style>
*{
    transition: all 0.6s;
}

html {
    height: 100%;
}

body{
    font-family: 'Lato', sans-serif;
    color: #888;
    margin: 0;
}

#main{
    display: table;
    width: 100%;
    height: 100vh;
    text-align: center;
}

.fof{
	  display: table-cell;
	  vertical-align: middle;
}

.fof h1{
	  font-size: 50px;
	  display: inline-block;
	  padding-right: 12px;
	  animation: type .5s alternate infinite;
}

@keyframes type{
	  from{box-shadow: inset -3px 0px 0px #888;}
	  to{box-shadow: inset -3px 0px 0px transparent;}
}
</style>
<div id="main">
    	<div class="fof">
        		<h1>Welcome</h1><br>
        		<h2>Bitname Agency Framework {{ $title }}</h2>
				<br>Change page content. Location:: /bitnameagencyframework/resources/views/main.blade.php<br>
				POST: @dd($post)
			
	<form method="POST">				
				<p><input type="text" name="input" size="20">
				
				 
				 @captcha
				 
							 
				<input type="submit" value="Submit"></p>
				
				</form>

    	</div>
</div>
