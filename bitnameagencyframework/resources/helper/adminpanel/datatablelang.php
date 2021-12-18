<?php
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}
class datatablelang extends Helper {
	
	public function index(){
		immunity(true);
		header('Content-Type: application/json; charset=utf-8');
		hookSystem::add_action("index", function(){			

			
			return json_encode(array (
  'emptyTable' => __('emptyTable', 'Tabloda herhangi bir veri mevcut değil'),
  'info' => __('info', '_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor'),
  'infoEmpty' => __('infoEmpty', 'Kayıt yok'),
  'infoFiltered' => __('infoFiltered', '(_MAX_ kayıt içerisinden bulunan)'),
  'infoThousands' => __('infoThousands', '.'),
  'lengthMenu' => __('lengthMenu', 'Sayfada _MENU_ kayıt göster'),
  'loadingRecords' => __('loadingRecords', 'Yükleniyor...'),
  'processing' => __('processing', 'İşleniyor...'),
  'search' => __('search', 'Ara:'),
  'zeroRecords' => __('zeroRecords', 'Eşleşen kayıt bulunamadı'),
  'paginate' => 
  array (
    'first' => __('first', 'İlk'),
    'last' => __('last', 'Son'),
    'next' => __('next', 'Sonraki'),
    'previous' => __('previous', 'Önceki'),
  ),
  'aria' => 
  array (
    'sortAscending' => __('sortAscending', ': artan sütun sıralamasını aktifleştir'),
    'sortDescending' => __('sortDescending', ': azalan sütun sıralamasını aktifleştir'),
  ),
  'select' => 
  array (
    'rows' => 
    array (
      '_' => __('_', '%d kayıt seçildi'),
      1 => __(1, '1 kayıt seçildi'),
    ),
    'cells' => 
    array (
      1 => __(1, '1 hücre seçildi'),
      '_' => __('_', '%d hücre seçildi'),
    ),
    'columns' => 
    array (
      1 => __(1, '1 sütun seçildi'),
      '_' => __('_', '%d sütun seçildi'),
    ),
  ),
  'autoFill' => 
  array (
    'cancel' => __('cancel', 'İptal'),
    'fillHorizontal' => __('fillHorizontal', 'Hücreleri yatay olarak doldur'),
    'fillVertical' => __('fillVertical', 'Hücreleri dikey olarak doldur'),
    'fill' => __('fill', 'Bütün hücreleri <i>%d</i> ile doldur'),
  ),
  'buttons' => 
  array (
    'collection' => __('collection', 'Koleksiyon <span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-s"></span>'),
    'colvis' => __('colvis', 'Sütun görünürlüğü'),
    'colvisRestore' => __('colvisRestore', 'Görünürlüğü eski haline getir'),
    'copySuccess' => 
    array (
      1 => __(1, '1 satır panoya kopyalandı'),
      '_' => __('_', '%ds satır panoya kopyalandı'),
    ),
    'copyTitle' => __('copyTitle', 'Panoya kopyala'),
    'csv' => __('csv', 'CSV'),
    'excel' => __('excel', 'Excel'),
    'pageLength' => 
    array (
      -1 => __("-1", 'Bütün satırları göster'),
      '_' => __('_', '%d satır göster'),
    ),
    'pdf' => __('pdf', 'PDF'),
    'print' => __('print', 'Yazdır'),
    'copy' => __('copy', 'Kopyala'),
    'copyKeys' => __('copyKeys', 'Tablodaki veriyi kopyalamak için CTRL veya u2318 + C tuşlarına basınız. İptal etmek için bu mesaja tıklayın veya escape tuşuna basın.'),
  ),
  'searchBuilder' => 
  array (
    'add' => __('add', 'Koşul Ekle'),
    'button' => 
    array (
      0 => __(0, 'Arama Oluşturucu'),
      '_' => __('_', 'Arama Oluşturucu (%d)'),
    ),
    'condition' => __('condition', 'Koşul'),
    'conditions' => 
    array (
      'date' => 
      array (
        'after' => __('after', 'Sonra'),
        'before' => __('before', 'Önce'),
        'between' => __('between', 'Arasında'),
        'empty' => __('empty', 'Boş'),
        'equals' => __('equals', 'Eşittir'),
        'not' => __('not', 'Değildir'),
        'notBetween' => __('notBetween', 'Dışında'),
        'notEmpty' => __('notEmpty', 'Dolu'),
      ),
      'number' => 
      array (
        'between' => __('between', 'Arasında'),
        'empty' => __('empty', 'Boş'),
        'equals' => __('equals', 'Eşittir'),
        'gt' => __('gt', 'Büyüktür'),
        'gte' => __('gte', 'Büyük eşittir'),
        'lt' => __('lt', 'Küçüktür'),
        'lte' => __('lte', 'Küçük eşittir'),
        'not' => __('not', 'Değildir'),
        'notBetween' => __('notBetween', 'Dışında'),
        'notEmpty' => __('notEmpty', 'Dolu'),
      ),
      'string' => 
      array (
        'contains' => __('contains', 'İçerir'),
        'empty' => __('empty', 'Boş'),
        'endsWith' => __('endsWith', 'İle biter'),
        'equals' => __('equals', 'Eşittir'),
        'not' => __('not', 'Değildir'),
        'notEmpty' => __('notEmpty', 'Dolu'),
        'startsWith' => __('startsWith', 'İle başlar'),
      ),
      'array' => 
      array (
        'contains' => __('contains', 'İçerir'),
        'empty' => __('empty', 'Boş'),
        'equals' => __('equals', 'Eşittir'),
        'not' => __('not', 'Değildir'),
        'notEmpty' => __('notEmpty', 'Dolu'),
        'without' => __('without', 'Hariç'),
      ),
    ),
    'data' => __('data', 'Veri'),
    'deleteTitle' => __('deleteTitle', 'Filtreleme kuralını silin'),
    'leftTitle' => __('leftTitle', 'Kriteri dışarı çıkart'),
    'logicAnd' => __('logicAnd', 've'),
    'logicOr' => __('logicOr', 'veya'),
    'rightTitle' => __('rightTitle', 'Kriteri içeri al'),
    'title' => 
    array (
      0 => __(0, 'Arama Oluşturucu'),
      '_' => __('_', 'Arama Oluşturucu (%d)'),
    ),
    'value' => __('value', 'Değer'),
    'clearAll' => __('clearAll', 'Filtreleri Temizle'),
  ),
  'searchPanes' => 
  array (
    'clearMessage' => __('clearMessage', 'Hepsini Temizle'),
    'collapse' => 
    array (
      0 => __(0, 'Arama Bölmesi'),
      '_' => __('_', 'Arama Bölmesi (%d)'),
    ),
    'count' => '{total}',
    'countFiltered' => '{shown}/{total}',
    'emptyPanes' => __('emptyPanes', 'Arama Bölmesi yok'),
    'loadMessage' => __('loadMessage', 'Arama Bölmeleri yükleniyor ...'),
    'title' => __('title', 'Etkin filtreler - %d'),
  ),
  'thousands' => '.',
  'datetime' => 
  array (
    'amPm' => 
    array (
      0 => 'öö',
      1 => 'ös',
    ),
    'hours' => __('hours', 'Saat'),
    'minutes' => __('minutes', 'Dakika'),
    'next' => __('next', 'Sonraki'),
    'previous' => __('previous', 'Önceki'),
    'seconds' => __('seconds', 'Saniye'),
    'unknown' => __('unknown', 'Bilinmeyen'),
    'weekdays' => 
    array (
      6 => __(6, 'Paz'),
      5 => __(5, 'Cmt'),
      4 => __(4, 'Cum'),
      3 => __(3, 'Per'),
      2 => __(2, 'Çar'),
      1 => __(1, 'Sal'),
      0 => __(0, 'Pzt'),
    ),
    'months' => 
    array (
      9 => __(9, 'Ekim'),
      8 => __(8, 'Eylül'),
      7 => __(7, 'Ağustos'),
      6 => __(6, 'Temmuz'),
      5 => __(5, 'Haziran'),
      4 => __(4, 'Mayıs'),
      3 => __(3, 'Nisan'),
      2 => __(2, 'Mart'),
      11 => __(11, 'Aralık'),
      10 => __(10, 'Kasım'),
      1 => __(1, 'Şubat'),
      0 => __(0, 'Ocak'),
    ),
  ),
  'decimal' => ',',
  'editor' => 
  array (
    'close' => __('close', 'Kapat'),
    'create' => 
    array (
      'button' => __('button', 'Yeni'),
      'submit' => __('submit', 'Kaydet'),
      'title' => __('title', 'Yeni kayıt oluştur'),
    ),
    'edit' => 
    array (
      'button' => __('button', 'Düzenle'),
      'submit' => __('submit', 'Güncelle'),
      'title' => __('title', 'Kaydı düzenle'),
    ),
    'error' => 
    array (
      'system' => __('system', 'Bir sistem hatası oluştu (Ayrıntılı bilgi)'),
    ),
    'multi' => 
    array (
      'info' => __('info', 'Seçili kayıtlar bu alanda farklı değerler içeriyor. Seçili kayıtların hepsinde bu alana aynı değeri atamak için buraya tıklayın; aksi halde her kayıt bu alanda kendi değerini koruyacak.'),
      'noMulti' => __('noMulti', 'Bu alan bir grup olarak değil ancak tekil olarak düzenlenebilir.'),
      'restore' => __('restore', 'Değişiklikleri geri al'),
      'title' => __('title', 'Çoklu değer'),
    ),
    'remove' => 
    array (
      'button' => __('button', 'Sil'),
      'confirm' => 
      array (
        '_' => __('_', '%d adet kaydı silmek istediğinize emin misiniz?'),
        1 => __(1, 'Bu kaydı silmek istediğinizden emin misiniz?'),
      ),
      'submit' => __('submit', 'Sil'),
      'title' => __('title', 'Kayıtları sil'),
    ),
  ),
));
			
	
			
		});
		
	}
	
	
}