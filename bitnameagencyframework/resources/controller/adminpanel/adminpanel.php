<?php
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}

immunity(true);

class adminPanel extends Controller
{
	function __construct(){
		
		$this->User = new User;
		$this->headerControl();
	}
	
	public function headerControl(){
		
		 $this->search_text = __("search_text", "Arama Yap");
		 $this->logout_text = __("logout_text", "Çıkış Yap");
				
	}

    public function index($url)
    {
		
		

        $this->url = $url;

        $this->welcometext = array(
            "title" => __("title", "Hoş geldiniz.") ,
            "sub" => __("sub", "Hesabınızda oturum açın ve web sitenizi yönetmeye başlayın.")
        );
		

        if (@$_POST['username'] and @$_POST['password'])
        {
						            
            if ($this->User->login($_POST['username'], $_POST['password']))
            {
                //giris yapıldı
                
		
                $subtext = $this->view("static/bootstrap/alert", [
				"class" => "success",
				"text" => __("sub", "Giriş Başarılı. Yönlendiriliyorsunuz...") 
				
				]);

                $this->welcometext = array(
                    "title" => __("title", "Hoş geldiniz") ,
                    "sub" => $subtext
                );

                hookSystem::add_action("index", function ()
                {

                    return $this->view("static/refresh", ['second' => 3, "url" => activeURL()]);

                });
				
					

            }
            else
            {
                //kullanıcı adı veya şifr yanlıs
                $subtext = $this->view("static/bootstrap/alert", [
				"class" => "danger",
				"text" => __("sub", "Kullanıcı adı veya şifre yanlış.") 
				
				]);

                $this->welcometext = array(
                    "title" => __("title", "Hoş geldiniz"),
                    "sub" => $subtext
                );

            }

        }

        hookSystem::add_action("index", function ($PREdata)
        {


            if (@$this->User->login() == false)
            {
                //giriş yapılmadı
                
			/*	if (Route::endURL() !== "login")
                {

                    self::redirect("login");

                }*/
              

                return $PREdata . '' . $this->view("adminpanel/login/login", ["title" => __("title", "Bitname F. Giriş Sayfası") , "description" => __("description", "Bitname F. Giriş Sayfası") , "helptext" => __("helptext", "Yardım") , "helptexthref" => __("helptexthref", "mailto:destek@bitnameagency.com") , "aboutustext" => __("aboutustext", "Hakkımızda") , "aboutustexthref" => __("aboutustexthref", "https://bitnameagency.com") , "slider" => array(
                    array(
                        "title" => "Her eylemin atası düşüncedir.",
                        "description" => "(Ralph Waldo Emerson)",
                        "imageurl" => serverName . "/bitnameagencyframework/admin/themes/default/dist/img/bg1.jpg"
                    ) ,
                    array(
                        "title" => "Mutlak hedef, başkalarının fikirlerinden bağımsız olabilmektir.",
                        "description" => "(Josef Bruer)",
                        "imageurl" => serverName . "/bitnameagencyframework/admin/themes/default/dist/img/bg2.jpg"
                    )
                ) , "welcome" => $this->welcometext, "usernameplaceholder" => __("usernameplaceholder", "Kullanıcı Adı") , "passwordplaceholder" => __("passwordplaceholder", "Şifre") , "rememberme" => __("rememberme", "Beni Hatırla") , "logintext" => __("logintext", "Giriş Yap") ]);

			}else{
				
				$this->User->permCheck("baf@login");	//yetki sorgula
                //giriş yapılmış
                
				  if (Route::endURL() == "login")
                {

                    self::redirect("dashboard");

                }
				
				
				
				 if (Route::endURL() == "dashboard")
                {
					$this->User->permCheck("baf@dashboard");	//yetki sorgula
						
						hookSystem::add_action("script", function($data){	
						return $data.''.$this->view("adminpanel/toasteralert", [
						"title" => __("welcome", "Hoşgeldiniz"),
						"text" => __("welcomeSub", "Hoşgeldiniz")		
						]);							
						});
						

						return $this->view("adminpanel/dashboard/boardWidget", [
						"langcode" => $_COOKIE['language'],
						"title" => __("title", "Dashboard | BAF"),
						"boardWidget" => __("boardWidget", "Yönetim Widget"),
						"boardWidgetSub" => __("boardWidgetSub", "Kullanımınızı kolaylaştıracak widgetlar."),							
						"search_text" => $this->search_text,
						"logout_text" => $this->logout_text,
						
						]);
						
						
						
					
			
                }
				
				
				
				if (Route::endURL() == "workstation")
                {
					$this->User->permCheck("baf@workstation");	//yetki sorgula
				
						$workstationModel = $this->model('adminpanel/workstationmodel');
						$workstationModeldataList = $workstationModel->dataList();
					
						if(isset($_POST['status'])){
						$workStation = new workStation($_POST['ws_IS']);
						$workStation = $workStation->statusChange($_POST['status']);	
						self::redirect("workstation");
						
						}
						
						if(isset($_POST['delete'])){
						$workStation = new workStation($_POST['ws_IS']);
						$workStation = $workStation->remove();	
						self::redirect("workstation");
						}
						
						if(isset($_POST['saveTitleDesc'])){
						$workStation = new workStation($_POST['ws_IS']);
						$workStation->titleChange($_POST['ws_Title']);	
						$workStation->descChange($_POST['ws_Description']);	
						self::redirect("workstation");
						}

						return $this->view("adminpanel/workstation/workStation", [
						"langcode" => $_COOKIE['language'],
						"title" => __("title", "Workstation | BAF"),
						"search_text" => $this->search_text,
						"logout_text" => $this->logout_text,
						"workstationModeldataList" => $workstationModeldataList,
						"workstation_title" => __("workstation_title", "İş Yönetim İstasyonu"),
						"workstation_title_sub" => __("workstation_title_sub", "BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz."),
						"disableButtontext" => __("disableButtontext", "Etkisizleştir"),
						"enableButtontext" => __("enableButtontext", "Etkinleştir"),
						"priority" => __("priority","Öncelik"),
						"save" => __("save","Kaydet"),
						"location" => __("location", "Lokasyon:"),
						"delete" => __("delete","Sil"),
						"placeholder_title" => __("placeholder_title", "Başlık"),
						"placeholder_desc" => __("placeholder_desc", "Açıklama")
						]);
				

                }
				 
				 
				if (Route::endURL() == "menuSystem")
                {
					
					$this->User->permCheck("baf@menuSystem");	//yetki sorgula
						
					$menu = new menu;
					$menuList = $menu->groupKey()->select();
					
					
					
					
					if(@$_GET['groupKey']){
					$getList = $menu->groupKey()->select($_GET['groupKey']);
						if(isset($getList[0])){
							$_SESSION['groupKey'] = $_GET['groupKey'];						
						}else{
							$_SESSION['groupKey'] = null;
							self::redirect("menuSystem");
						}					
					}else{
						
						if(@$_SESSION['groupKey'] !== null){
							
							self::redirect("menuSystem?groupKey=".$_SESSION['groupKey']);
							
						}
						
					}


						if(isset($_POST['RemoveMenu'])){
						$menu = $menu->groupKey()->remove($_POST['RemoveMenu']);
						self::redirect("menuSystem");
						}
						
						if(isset($_POST['NewMenu'])){						
						$menu = $menu->groupKey()->create($_POST['NewgroupKey']);
						self::redirect("menuSystem?groupKey=".text2slug($_POST['NewgroupKey']));
						}
						
						
						if(isset($_POST['delete-item'])){							
						$menu = $menu->children()->remove((int)$_POST['delete-item']);
						self::redirect("menuSystem");
						}	
						
						
						
						if(isset($_POST['item_add_button'])){						

							if(empty($_POST['itemKey'])){
								
								$_POST['itemKey'] = 'Bitname Agency';
								
							}
							
							if(empty($_POST['itemLink'])){
								
								$_POST['itemLink'] = 'https://bitnameagency.com';
								
							}
							
							if(!in_array($_POST['itemTarget'], [
							"_self", "_blank", "_parent", "_top", "framename"							
							])){
								
								$_POST['itemTarget'] = '_self';
								
							}
												
						
						$menu->children()->create([
						"subID" => 0,
						"itemKey" => $_POST['itemKey'],
						"itemLink" => $_POST['itemLink'],
						"itemTarget" => $_POST['itemTarget'],
						"groupKey" => $_GET['groupKey'],
						"orderInt" => 1
						]);			
						
						self::redirect("menuSystem");
						
						}
						
						
						
						if(isset($_POST['childrenEditbutton'])){
							
													
							$itemData = $menu->children()->select((int)$_POST['childrenID']);	
									
									
							$menu->children()->update([
							"itemKeyorID" => (int)$_POST['childrenID'],
							"subID" => (int)$itemData['subID'],
							"itemKey" => $_POST['itemKey'],
							"itemLink" => $_POST['itemLink'],
							"itemTarget" => $_POST['itemTarget'],
							"groupKey" => $itemData['groupKey'],
							"orderInt" => $itemData['orderInt']
							]);			
							
							
						self::redirect("menuSystem");							
						}
				

						$nestable = $this->helper("adminpanel/menunestable");	
						$nestable = $nestable->construct(@$_GET['groupKey'], @$getList);
						$nestableRender = $nestable->Render();
						
						
						if(isset($_POST['menuDesign'])){
							
							
							$menuDesign = json_decode($_POST['menuDesign']);							
							$menuDesign = objectToArray($menuDesign);
							$backRender = $nestable::backRender($menuDesign);
							
								
							foreach($backRender as $data){					
		
								$itemData = $menu->children()->select($data['ID']);																
								
								$menu->children()->update([
								"itemKeyorID" => $data['ID'],
								"subID" => $data['subID'],
								"itemKey" => $itemData['itemKey'],
								"itemLink" => $itemData['itemLink'],
								"itemTarget" => $itemData['itemTarget'],
								"groupKey" => $itemData['groupKey'],
								"orderInt" => $data['orderInt']
								]);	
								
							}
							
			
							self::redirect("menuSystem");
							 
						}

			
						
					
				
						return $this->view("adminpanel/menusystem/menusystem", [
						"langcode" => $_COOKIE['language'],
						"title" => __("title", "MenuSystem | BAF"),
						"search_text" => $this->search_text,
						"logout_text" => $this->logout_text,
						"menuselect" => $this->view("adminpanel/menusystem/menuselect", [
						"menuSelectplaceholder" => __("menuSelectplaceholder", "Menü Seçiniz"),
						"menuList" => $menuList,
									
						]),
						"nestableID" => @$_GET['groupKey'],
				
						"nestableRender" => $nestableRender,
						"sectionTitle" => __("sectionTitle", "Menü Yönetim Sistemi"),
						"sectionSub" => __("sectionSub", "Menü oluşturabilir, düzenleyebilir ve silebilirsiniz. Ayrıca sıralama ve hiyerarşi oluşturabilirsiniz."),
						"new_menu_placeholder" => __("new_menu_placeholder", "Yeni Menü İsmi"),
						"new_menu_button" => __("new_menu_button", "Yeni Menü Oluştur"),						
						"selectedMenu" => __("selectedMenu", "Seçilen Menü"),
						"deleteMenu" => __("deleteMenu", "Menüyü Sil"),
						"nestable_title" => __("nestable_title", "Menüyü Düzenle"),
						"nestableUpdate_button" => __("nestableUpdate_button", "Sıralamayı Güncelle"),
						"item_add_title" => __("item_add_title", "Yeni Bağlantı Ekle"),
						"itemKey_Placeholder" => __("itemKey_Placeholder", "itemKey"),
						"itemLink_Placeholder" => __("itemLink_Placeholder", "itemLink"),
						"itemTarget" => __("itemTarget", "linkTarget"),
						"item_add_button" => __("item_add_button", "Link Ekle"),
						"Test1" => "adasd",
						]);
				
				
				
				
					
				} 
				 
				 
				 if (Route::endURL() == "languages")
                {
					$this->User->permCheck("baf@languages");	//yetki sorgula
					
					$originalLanguageCode = 'original';
					
					$translators = new translators;
					
					
					$languageList = $translators->language()->select();		
					
				
					if(@$_GET['languageSelect']){
						
						$selectedLanguage = $translators->language()->select($_GET['languageSelect']);	
						
						$pathList = $translators->pathList()->select([
						"lang_codeorlang_ID" => $originalLanguageCode
						]);		
						
						

						$sentenceList = $translators->sentence()->select([
						"lang_codeorlang_ID" => $originalLanguageCode,
						"ws_Path" => @$_GET['pathSelect']
						]);		
												
						if(isset($selectedLanguage['lang_code'])){
							
							$_SESSION['languageSelect'] = $_GET['languageSelect'];	
							
						}else{
							
							$_SESSION['languageSelect'] = null;
							self::redirect("languages");
							
						}
						
					}else{
						
						if(@$_SESSION['languageSelect'] !== null){
							
							self::redirect("languages?languageSelect=".$_SESSION['languageSelect']);
							
						}
						
					}
					
					
					if(isset($_POST['NewLanguage'])){
					$translators = $translators->language()->create([
						"lang_code" => text2slug($_POST['NewLanguageName']),
						"lang_flag" => "noflag.jpg",
						"lang_name" => $_POST['NewLanguageName']
					]);    
					self::redirect("languages");
					}
					
					
					if(isset($_POST['RemoveLanguage'])){						
					$translators = $translators->language()->remove([
						"lang_codeorlang_ID" => $_POST['RemoveLanguage']
					]);							
					self::redirect("languages");
					}
					
					if(isset($_POST['lang_update'])){						
					$translators = $translators->language()->update([
					"lang_codeorlang_ID" => $_POST['old_lang_code'],
					"lang_code" => $_POST['lang_code'],
					"lang_flag" => $_POST['lang_flag'],
					"lang_name" => $_POST['lang_name']
					]);						
					self::redirect("languages?languageSelect=".$_POST['lang_code']);
					}
				
					if(isset($_POST['sentenceUpdate'])){
					$translators = $translators->sentence()->update([
					"ts_ID" => $_POST['ts_ID'],
					"ts_sentence" => $_POST['ts_sentence']
					]);	
					self::redirect("languages?languageSelect=".$_GET['languageSelect']."&pathSelect=".$_GET['pathSelect'].'#ID_'.$_POST['divID']);
					}
					
					
					if(isset($_POST['sentenceNew'])){
					$translators = $translators->sentence()->create([
					"lang_code" => $_GET['languageSelect'],
					"ts_path" => $_GET['pathSelect'],
					"ts_path_line" => $_POST['ts_path_line'],
					"ts_key" => $_POST['ts_key'],
					"ts_sentence" => $_POST['ts_sentence']
					]);
					self::redirect("languages?languageSelect=".$_GET['languageSelect']."&pathSelect=".$_GET['pathSelect'].'#ID_'.$_POST['divID']);
					}
					
					if(isset($_POST['sentenceDelete'])){
					$translators = $translators->sentence()->remove($_POST['sentenceDelete']);						
					self::redirect("languages?languageSelect=".$_GET['languageSelect']."&pathSelect=".$_GET['pathSelect'].'#ID_'.$_POST['divID']);
					}
					
					
					
					return $this->view("adminpanel/languages/languages", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Languages | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Dil Yönetim Sistemi"),
					"sectionSub" => __("sectionSub", "Mevcut dil paketlerini yönetebilir. Yeni dil paketleri oluşturabilirsiniz."),
					"NewLanguage_placeholder" => __("NewLanguage_placeholder", "Yeni Dil İsmi"),
					"NewLanguage_button" => __("new_menu_button", "Yeni Dil Paketi Oluştur"),
					"languageselect" => $this->view("adminpanel/languages/languageselect", [
					"languageSelectplaceholder" => __("languageSelectplaceholder", "Dil Paketi Seçiniz"),
					"languageList" => $languageList]),
					"selectedLanguageText" => __("selectedLanguageText", "Seçilen Dil Paketi:"),
					"selectedLanguage" => @$selectedLanguage['lang_name'],
					"deleteLanguageText" => __("deleteLanguageText", "Dil Paketini Sil"),
					"selectedLanguageID" => @$selectedLanguage['lang_ID'],
					"languageEditbutton_text" => __("languageEditbutton_text", "Dil Paketini Düzenle"),
					"lang_code_text" => __("lang_code_text", "Dil Kodu"),
					"lang_flag_text" => __("lang_flag_text", "Dil Bayrağı"),
					"lang_name_text" => __("lang_name_text", "Dil İsmi"),
					"lang_name_value" => @$selectedLanguage['lang_name'],
					"lang_code_value" => @$selectedLanguage['lang_code'],
					"lang_flag_value" => @$selectedLanguage['lang_flag'],
					"lang_update_text" => __("lang_update_text", "Kaydet"),
					"pathselect" => $this->view("adminpanel/languages/pathselect", [
					"PathSelectText" => __("PathSelectText", "Dosya Yolunu Seçiniz"),
					"pathList" => @$pathList,
					"backButton" => __("backButton", "Önceki"),
					"nextButton" => __("nextButton", "Sonraki")				
					]),
					"sentenceList" => @$sentenceList,
					"line_text" => __("line_text", "SATIR"),
					"key_text" => __("key_text", "ANAHTAR"),
					"action_text" => __("action_text", "AKSİYON"),
					"sentence_text" => __("sentence_text", "CÜMLE"),
					"saveText" => __("saveText", "Kaydet"),
					"viewURLtext" => __("viewURLtext", "İlgili URL'ye Git"),
					"viewCodetext" => __("viewCodetext", "İlgili Kodu Gör"),
					"debugView" => $this->view("adminpanel/languages/debug", [
					"debugText" => __("debugText", "Hata Ayıklayıcı"),
					"closeText" => __("closeText", "Kapat"),
					"startText" => __("startText", "Başlat"),
					"loadingText" => __("loadingText", "Bekleyiniz..."),
					"successText" => __("successText", "Başarılı!"),
					
					
					]),
					
					
					
					]);
					
				}
				
				 if (Route::endURL() == "fileReader")
                {	
					$this->User->permCheck("baf@fileReader");	//yetki sorgula
					header('Content-Type: application/json; charset=utf-8');
					return @translators::debugMode($_GET['hash']);
					
				}
				
				
				if (Route::endURL() == "debugStart")					
                {	
					$this->User->permCheck("baf@debugStart");	//yetki sorgula
					$translators = new translators;					
					header('Content-Type: application/json; charset=utf-8');
					$translators->debugFixer();
					return json_encode(["status" => true]);
					
				}
				
				
				 if (Route::endURL() == "savedisk")
                {
					$this->User->permCheck("baf@savedisk");	//yetki sorgula
					$saveDisk = new saveDisk;
					$pathList =  $saveDisk->pathList();		
					
					if(@$_GET['pathSelect']){
					$itemList = $saveDisk->pathList($_GET['pathSelect']);
					}
					
					if(isset($_POST['itemDelete'])){					
					$saveDisk = $saveDisk->remove($_POST['itemDelete']);		
					self::redirect("savedisk?languageSelect=".$_GET['languageSelect']."&pathSelect=".$_GET['pathSelect'].'#ID_'.$_POST['divID']);
					}
		
					
					return $this->view("adminpanel/savedisk/savedisk", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "SaveDisk | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "SaveDisk Sistemi"),
					"sectionSub" => __("sectionSub", "Sistemde panelden değiştirilebilen değişkenler oluşturabilirsiniz."),
					"pathSelectView" => $this->view("adminpanel/savedisk/pathselect", [
					"pathListplaceholder" => __("pathListplaceholder", "Dosya Yolunu Seçiniz"),
					"pathList" => @$pathList					
					]),
					"itemList" => @$itemList,
					"lineText" => __("lineText", "SATIR"),
					"keyText" => __("keyText", "ANAHTAR"),
					"dataText" => __("dataText", "VERİ"),
					"actionText" => __("actionText", "AKSİYON"),
	
					]);
					
				}
				
				
				 if (Route::endURL() == "users")
                {
					
					$this->User->permCheck("baf@users");	//yetki sorgula
					$User = new User;
					$userList = $User->userList();
					
					
				
				
				
					
					
				
		
					
					return $this->view("adminpanel/users/users", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Kullanıcılar | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Kullanıcılar "),
					"sectionSub" => __("sectionSub", "Sistemdeki tüm üyeleri görüntüleyebilirsiniz."),
					"ID_text" => __("ID_text", "ID"),
					"userKey_text" => __("userKey_text", "userKey"),
					"loginInput_text" => __("loginInput_text", "Giriş Değeri"),
					"action_text" => __("action_text", "Aksiyon"),
					"userList" => @$userList,
					"viewOption_text" => __("viewOption_text", "Görüntüle"),
					"userOptionempty_text" => __("userOptionempty_text", "Veri Bulunamadı!"),
					"userSelect_text" => __("userSelect_text", "Kullanıcıyı Seç"),
					
					]);
					
				}
				
				if (Route::endURL() == "userselect")					
                {	
					$this->User->permCheck("baf@userselect");	//yetki sorgula
					$User = new User;
					
					if(isset($_GET['userKey'])){
						$getData = $User->getData($_GET['userKey']);
						$userOptions = $User->userOption($_GET['userKey']);		
						$resetPasswordURL = $User->resetPasswordURL($_GET['userKey']);
					}
					
					if(isset($_POST['userDelete'])){
						$User->UserDelete($_GET['userKey']);	
						self::redirect("../adminPanel/userselect?userKey=".$_GET['userKey']);
					}
					
					if(!empty($getData['bannedDate'])){ //Banlı							
							$bannedAlert = $this->view("static/bootstrap/alert", [
							"class" => "warning",
							"text" => '<i class="fas fa-ban"></i> '.__("bannedAlert", "Bu Hesap Ban Cezası Aldı!").' ('.$getData['bannedDate'].')',
							]);						
					}
					
					if($getData['deleted'] == 1){
						$deletedAlert = $this->view("static/bootstrap/alert", [
						"class" => "danger",
						"text" => '<i class="fas fa-times-circle"></i> '.__("deletedAlert", "Bu Hesap Silindi!")
						]);					
					}
					
					if(isset($_POST['bannedDay'])){						
					$banned = $User->userBanned($_GET['userKey'], $_POST['bannedDay']);	
					self::redirect("../adminPanel/userselect?userKey=".$_GET['userKey']);
					}
					
					
					
					
					
					
					return $this->view("adminpanel/userselect/userselect", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Kullanıcı İşlemleri | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Kullanıcı İşlemleri"),
					"sectionSub" => __("sectionSub", "Kullanıcıyla ilgili düzenlemeler."),
					"userData" => @$getData,
					"userOptions" => @$userOptions,
					"emptyOption" => __("emptyOption", "Veri Bulunamadı!"),
					"userOptions_text" => __("userOptions_text", "Tüm Kullanıcı Verileri"),
					"deleteUser_text" => __("deleteUser_text", "Üyeyi Sil"),
					"userBanned_text" => __("userBanned_text", "Üye Banla"),
					"userBannedClose_text" => __("userBannedClose_text", "Vazgeç"),
					"bannedAlert" => @$bannedAlert,
					"deletedAlert" => @$deletedAlert,
					"bannedDay_placeholder" => __("bannedDay_placeholder", "Kaç gün banlanacak?"),
					"bannedButton" => __("bannedButton", "Banla"),
					"resetPassword_text" => __("resetPassword_text", "Şifre Sıfırla"),
					"Roles_text" => __("Roles_text", "Roller"),
					"sessions_text" => __("sessions_text", "Oturum Listesi"),					
					"resetPasswordURL" => @$resetPasswordURL,

					]);
					
				}
				
				 if (Route::endURL() == "projects")
                {
					$this->User->permCheck("baf@projects");	//yetki sorgula
					$User = new User;
					
				if(isset($_POST['NewProject'])){
					$user = $User->perm([
					"projectKey" => $_POST['NewProjectKey'],
					"permKey" => "login"
					]);		
					self::redirect("projects?projectKey=".text2slug($_POST['NewProjectKey']));
	
				}
				
				$projectList = $User->perm();	
				
				if(isset($_GET['projectKey'])){
					$permList = $User->perm([
					"projectKey" => $_GET['projectKey']
					]);			
				}
				
				if(isset($_POST['RemoveProject'])){
				$user = $User->projectRemove($_GET['projectKey']);				
				self::redirect("projects?projectKey=".$_GET['projectKey']);	
				}
				
				if(isset($_POST['NewPermKey'])){
				$user = $User->perm([
				"projectKey" => $_GET['projectKey'],
				"permKey" => $_POST['NewPermKey']
				]);	
				self::redirect("projects?projectKey=".$_GET['projectKey']);	
				}
				
				if(isset($_POST['deletePermKey'])){
				$user = $User->permRemove([
				"projectKey" => $_GET['projectKey'],
				"permKey" => $_POST['deletePermKey']
				]);								
				self::redirect("projects?projectKey=".$_GET['projectKey']);	
				}
				
				return $this->view("adminpanel/projects/projects", [
				"langcode" => $_COOKIE['language'],
				"title" => __("title", "Projeler | BAF"),
				"search_text" => $this->search_text,
				"logout_text" => $this->logout_text,
				"sectionTitle" => __("sectionTitle", "Projeler"),
				"sectionSub" => __("sectionSub", "Sistemdeki proje kalıplarını görüntüler."),
				"newProjectName_text" => __("newProjectsName_text", "Yeni Proje İsmi"),
				"newProjectAddbutton_text" => __("newProjectAddbutton_text", "Yeni Proje Ekle"),
				"projectSelectView" => $this->view("adminpanel/projects/selectproject", 
				[
				"projectSelect_text" => __("projectSelect_text", "Proje Seçiniz"),
				"projectList" => @$projectList
				]),
				"selectProject_text" => __("selectProject_text", "Seçilen Proje"),
				"permList" => @$permList,
				"projectDeletebutton_text" => __("projectDeletebutton_text", "Projeyi Sil"),
				"newPermAddbutton_text" => __("newPermAddbutton_text", "Yeni Yetki Ekle"),
				"newKeyName_text" => __("newKeyName_text", "Yetki Key"),
				"permDelete_text" => __("permDelete_text", "Perm Sil"),
				
				]);
				
				}
				 
				 
				 if (Route::endURL() == "roles")
                {
					$this->User->permCheck("baf@roles");	//yetki sorgula
					$User = new User;
					
					$roleList = $User->roles();
					
					if(isset($_POST['NewRoleKey'])){						
					$user = $User->roles($_POST['NewRoleKey']);	
					self::redirect("roles");	
					}
					
					if(isset($_GET['roleKey'])){
					$selectRole = $User->roles($_GET['roleKey']);
					$projectList = $User->perm();					
					$rolePermList = $User->rolePermdata($_GET['roleKey']); 						
					}
					
					if(isset($_POST['RemoveRole'])){
					$user = $User->roleRemove($_GET['roleKey']);	
					self::redirect("roles");	
					}
					
					if(isset($_GET['projectKey'])){
					$projectPermList = $User->perm([
					"projectKey" => $_GET['projectKey']
					]);							
					foreach($rolePermList as $role){				
					unset($projectPermList[$role['projectKey'].'@'.$role['permKey']]);
					}}
					
					
					if(isset($_POST['negativePerm'])){					
					$user = $User->mergeRolePerm([
					"permID" => $_POST['permID'],
					"roleID" => $_POST['roleID'],
					"process" => "remove"
					]);			
					self::redirect("roles?roleKey=".$_GET['roleKey']."&projectKey=".$_GET['projectKey']);		
					}
					
					if(isset($_POST['positivePerm'])){						
					$user = $User->mergeRolePerm([
					"permID" => $_POST['permID'],
					"roleID" => $selectRole['roleID'],
					"process" => "insert"
					]);		
					self::redirect("roles?roleKey=".$_GET['roleKey']."&projectKey=".$_GET['projectKey']);						
					}
					
					return $this->view("adminpanel/roles/roles", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Roller | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Roller"),
					"sectionSub" => __("sectionSub", "Sistem rollerini buradan düzenleyebilirsiniz."),
					"newRoleName_text" => __("newRoleName_text", "Yeni Rol İsmi"),
					"newRoleAddbutton_text" => __("newRoleAddbutton_text", "Rol Ekle"),
					"roleSelectView" => $this->view("adminpanel/roles/selectrole",[
					"roleSelect_text" => __("roleSelect_text", "Rol Seçimi Yapınız."),
					"roleList" => @$roleList					
					]),
					"selectRoleText" => __("selectRoleText", "Seçilen Rol"),
					"roleDeletebutton_text" => __("roleDeletebutton_text", "Rolü Sil"),
					"RolePermListView" => $this->view("adminpanel/roles/rolepermlistview", [
					//Role perm List
					"rolePermList" => @$rolePermList,
					"emptyPerm_text" => __("emptyPerm_text", "Yetki Bulunamadı!"),
					]),
					"ProjectPermListView" => $this->view("adminpanel/roles/projectpermlistview", [
					//project perm list
					"projectsSelect_text" => __("projectsSelect_text", "Proje Seç"),
					"projectList" => @$projectList,
					"projectPermList" => @$projectPermList,
					"emptyPerm_text" => __("emptyPerm_text", "Yetki Bulunamadı!"),
					
					]),
					
					]);
				
				}


								
				 if (Route::endURL() == "userroles")
                {
					$this->User->permCheck("baf@userroles");	//yetki sorgula
					
					if(isset($_GET['userKey'])){
					$User = new user;
					$userData = $User->getData($_GET['userKey']);					
					$userRoleList = $User->userRoleData($_GET['userKey']);
				
					$roleList = $User->roles();		
					foreach($userRoleList as $role){						
					unset($roleList[$role['roleKey']]);				
					}}
					
					if(isset($_POST['negativeRole'])){
					$user = $User->mergeRolesUser([
					"loginInputoruserKey" => $_GET['userKey'],
					"roleID" => $_POST['roleID'],
					"process" => "remove"
					]);		
					self::redirect("userroles?userKey=".$_GET['userKey']);		
					}
					
					if(isset($_POST['positiveRole'])){
					$user = $User->mergeRolesUser([
					"loginInputoruserKey" => $_GET['userKey'],
					"roleID" => $_POST['roleID'],
					"process" => "insert"
					]);	
					self::redirect("userroles?userKey=".$_GET['userKey']);	
					}
				
					return $this->view("adminpanel/userroles/userroles", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Kullanıcıya Rol Ver | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Kullanıcıya Rol Ver"),
					"sectionSub" => __("sectionSub", "Kullanıcılara buradan rol verebilirsiniz."),
					"userData" => @$userData,
					"userRoleListView" => $this->view("adminpanel/userroles/userRoleListView", [
					//userRoleListView
					"userRoleList" => @$userRoleList,
					"emptyRole_text" => __("emptyRole_text", "Rol Bulunamadı!")
					]),
					"roleListView" => $this->view("adminpanel/userroles/roleListView", [
					//roleListView
					"roleList" => @$roleList,
					"emptyRole_text" => __("emptyRole_text", "Rol Bulunamadı!")
					]),
					]);

				}
				
				 if (Route::endURL() == "loglist")
                {
					$this->User->permCheck("baf@loglist");	//yetki sorgula
					
					
		
					$logSystem = new logSystem;
					$logList = $logSystem->logList();		

					
					return $this->view("adminpanel/loglist/loglist", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Log Listesi | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Log Listesi"),
					"sectionSub" => __("sectionSub", "Tüm güvenlik verilerini indirebilirsiniz."),
					"logList" => @$logList,
					"dateTimeText" => __("dateTimeText", "Log Tarihi"),
					"downloadURLText" => __("downloadURLText", "İndirme Linki"),
					"emptyText" => __("emptyText", "Veri Yok!"),
					
					]);
					
				}
				
				 if (Route::endURL() == "sessionlist")
                {
					$this->User->permCheck("baf@sessionlist");	//yetki sorgula
				
					$sessionList = sessionList();
					
					if(isset($_GET['sessionSelect'])){
						
						$sessionListData = sessionList($_GET['sessionSelect']);
						
					}
					
					if(isset($_POST['sessionIDremove'])){
						sessionIDremove($_POST['sessionIDremove']);			
						self::redirect("sessionlist?sessionSelect=".$_GET['sessionSelect']);
					}
					
				
					return $this->view("adminpanel/sessionlist/sessionlist", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Oturum Listesi | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Oturum Listesi"),
					"sectionSub" => __("sectionSub", "Tüm oturumları görüntüleyebilirsiniz."),				
					"sessionListplaceholder" => __("sessionListplaceholder", "Session Key Seçiniz"),
					"sessionList" => @$sessionList,
					"ID_text" => __("ID_text", "ID"),
					"sessionKey_text" => __("sessionKey_text", "Oturum Anahtarı"),
					"sessionSecureKey_text" => __("sessionSecureKey_text", "Oturum Gizli Anahtarı"),
					"sessionData_text" => __("sessionData_text", "Oturum Verisi"),
					"sessionDelete_text" => __("sessionDelete_text", "Oturumu Sil"),
					"sessionListData" => @$sessionListData,
					
					
					]);
				
				}
				

					if (Route::endURL() == "search")
                {
					$this->User->permCheck("baf@search");	//yetki sorgula
					
					if(isset($_GET['q'])){						
					$bafsearch = $this->model('adminpanel/bafsearch');
					$result = $bafsearch->value($_GET['q']);
					}
                  
				
				   	return $this->view("adminpanel/search/search", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Arama Sonuçları | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Arama Sonuçları"),
					"sectionSub" => __("sectionSub", "Panel Arama Motoru"),				
					"result" => @$result,
					"empty_text" => __("empty_text", "Bulunamadı!"),
					
					
					]);
				

                }
				
				
				if (Route::endURL() == "routelist")
                {
					$this->User->permCheck("baf@routelist");	//yetki sorgula
					$routeList = Route::RouteSaver();
					   
				    return $this->view("adminpanel/routelist/routelist", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Rota Listesi | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Rota Listesi"),
					"sectionSub" => __("sectionSub", "Tüm rotaları görüntüleyebilirsiniz."),				
					"routeList" => @$routeList,
					"slugText" => __("slugText", "URL"),
					"filepathText" => __("filepathText", "Filepath"),
					"lineText" => __("lineText", "Satır"),
					"empty_text" => __("empty_text", "Bulunamadı!"),			
					
					]);

                }
				
				if (Route::endURL() == "systemoptions")
                {
					$this->User->permCheck("baf@systemoptions");	//yetki sorgula
				
					$allSystemOptions = allSystemOptions();
				
					if($_POST){
						
						foreach($_POST as $optionKey => $optionData){
							
							if($allSystemOptions[$optionKey]){
								
								systemOptions($optionKey, $optionData);
							
							}						
							
						}
						self::redirect("systemoptions");
					}
					   
				    return $this->view("adminpanel/systemoptions/systemoptions", [
					"langcode" => $_COOKIE['language'],
					"title" => __("title", "Sistem Seçenekleri | BAF"),
					"search_text" => $this->search_text,
					"logout_text" => $this->logout_text,
					"sectionTitle" => __("sectionTitle", "Sistem Seçenekleri"),
					"sectionSub" => __("sectionSub", "Sistem seçeneklerini düzenleyebilirsiniz."),				
					"allSystemOptions" => @$allSystemOptions,
					"save_text" => __("save_text", "Kaydet"),
					
					]);

                }
				
				
				if (Route::endURL() == "logout")
                {
					$this->User->permCheck("baf@logout");	//yetki sorgula
					
                    $this->User = $this->User->logout();
					self::redirect("login");

                }
				
				
            }
            

        });

        self::createRoot();

    }

    public function createRoot()
    {

        if (saveDisk("adminUserCreate") !== "YES")
        { // daha önce eklenme durumunu kontrol eder.
            //create admin account
            $this->username = 'root';
            $this->password = substr(md5(SECURE_KEY . '' . rand(11111, 99999)) , 0, 10);


				      
            if ($this->User->UserAdd($this->username, $this->password))
            {
                //eklendi
                Mailer::SendAdress(authorizedMail, authorizedMail);
                Mailer::Subject(__("mailsubject", "Admin hesabınız oluşturuldu!"));
                Mailer::Message(function ()
                {

                    return __("usernamemail", "Kullanıcı Adı") . ': ' . $this->username . '<br>
			' . __("passwordmail", "Şifre") . ': ' . $this->password . '';

                });
                Mailer::send();

                saveDisk("adminUserCreate", "YES"); //Admin kullanıcısının eklendiğini diske kaydeder.
                
            }

        }

    }

    public function redirect($url)
    {
        header("Location: /adminPanel/" . $url);
    }
	
	public function datatablelang(){
		
		$datatablelang = $this->helper("adminpanel/datatablelang");	
		return $datatablelang->index();
		
	}

}



