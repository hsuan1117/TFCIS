<?php
  ini_set("display_errors", TRUE);
  $signature = "";
  if(isset($_POST["submit"])){
  	//私鑰
    $key = base64_decode($_POST["key"]);
    
    
    $s = "";
    $str = openssl_sign('world', $s ,$key);
    $str = base64_encode($str);
    echo $str;
  }
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
		<script src="https://unpkg.com/vue/dist/vue.js"></script>
		<script src="https://unpkg.com/element-ui/lib/index.js"></script>
		<style>
			@font-face {
				font-family: FF;
				src: url(https://cdn.jsdelivr.net/gh/justfont/open-huninn-font@master/font/jf-openhuninn-1.0.ttf);
			}

			#app {
				font-family: FF, serif;
			}
		</style>
		<title>TFCIS Sign</title>
	</head>

	<body>
		<div id="app">
			<el-container>
				<el-header>TFCIS Sign</el-header>
				<el-main>
					<el-row>
					    <el-card v-if="signature != ''" :>
					        {{signature}}
					    </el-card>
					</el-row>
					<el-row>
						<el-form>
  							<el-form-item label="私鑰">
    								<el-input placeholder="私鑰" native-name="key" :model="privateKey"></el-input>
							</el-form-item>
							<el-form-item label="內容">
    								<el-input placeholder="內容" native-name="content" :model="content"></el-input>
							</el-form-item>
  							<el-form-item>
    								<el-button type="primary" native-type="submit" native-value="submit">送出</el-button>
    								<el-input placeholder="私鑰" native-type="hidden" native-value="submit"></el-input>
  							</el-form-item>
						</el-form>
					</el-row>
				</el-main>
			</el-container>

		</div>
	</body>

	<script>
		var Signer = new Vue({
			el: '#app',
			data: {
				privateKey:"",
				signature :"<?=signature ?>",
				content:""
			},
			methods: {
			    
			}
		})
	</script>
	<style>
		.el-header,
		.el-footer {
			background-color: #B3C0D1;
			color: #333;
			text-align: center;
			line-height: 60px;
		}

		.el-main {
			background-color: #E9EEF3;
			color: #333;
			text-align: center;
			line-height: 20px;
		}

		.el-picker-panel .el-date-picker {
			top: 5px !important;
		}
	</style>
</html>
