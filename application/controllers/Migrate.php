<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(ENVIRONMENT != "development") {
            echo '請勿再正式環境下執行 Migrate!!';
        } else {
            $this->load->library('migration');
        }   
    }

    public function index()
    {
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        } else {
            echo $this->migration->current();
        }
    }

    public function init()
    {
        $this->migration->version(0);
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        } else {
            echo $this->migration->current();
            $this->seeding();
        }
    }


    public function seeding() {
        // Admintable
        $insert_sql = <<<EOT
INSERT INTO `admintable` (`id`, `name`, `acc`, `pwd`, `pic`, `email`, `title`, `time`, `right`, `Recover`) VALUES
(1, 'admin', 'admin', '25f9e794323b453885f5181f1b624d0b', '', 'sheilawong@fff.com', '1', '2014-07-09', 1, 0);
EOT;
        $query = $this->db->query($insert_sql);


        // Admintype
        $insert_sql = <<<EOT
INSERT INTO `admintype` (`id`, `name`) VALUES
(1, '最高管理者'),
(2, '執行者');
EOT;
        $query = $this->db->query($insert_sql);


        // article
        $insert_sql = <<<EOT
INSERT INTO `article` (`id`, `panel`, `lang`, `type`, `name`, `pic`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `description`, `content`, `start_at`, `end_at`, `show`, `created_at`, `updated_at`, `recover`, `sort`, `field1`, `field2`, `field3`, `field4`, `field5`) VALUES
(1, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p class="desc-slide playfair-display text-italic">\r\n    來自天然酵母發酵，造就不老麵團傳奇</p>\r\n', NULL, NULL, 1, '2016-06-30 12:10:42', '2016-06-30 12:14:08', 0, 1, '/index.php/site/shop', NULL, NULL, NULL, NULL),
(2, 10, 1, NULL, '【免費】杏仁茶來店兌換卷', NULL, NULL, NULL, NULL, NULL, NULL, '2016.0601~0630，凡下載本券至元佬麵團任一分店消費(不限金額)，即贈送杏仁茶乙杯。', NULL, '2016-06-09 00:00:00', NULL, 1, '2016-06-30 12:25:27', '2016-06-30 12:25:45', 0, 1, '/', NULL, NULL, NULL, NULL),
(3, 10, 1, NULL, '【免費】杏仁茶來店兌換卷', NULL, NULL, NULL, NULL, NULL, NULL, '2016.0601~0630，凡下載本券至元佬麵團任一分店消費(不限金額)，即贈送杏仁茶乙杯。', NULL, '2016-06-15 00:00:00', NULL, 1, '2016-06-30 12:26:23', '0000-00-00 00:00:00', 0, 2, '/', NULL, NULL, NULL, NULL),
(4, 4, 1, 8, '放眼天下 獨家採訪', NULL, NULL, NULL, NULL, NULL, NULL, '現代人重注養生，對於麵包的選擇，也會想要吃全麥製作的麵包；然而，根據董氏基金會調查發現，仍有很多麵包店並不是以全麥製作麵包，但是卻可能標示全麥。所以，民眾要買全麥麵包時，可得要張大眼，而且要學會如何分辨全麥麵包。 原文標題: 全麥麵包挑選有秘訣', '<p>\r\n    <span style="color: rgb(81, 81, 81); font-family: Raleway, sans-serif; font-size: 16px; letter-spacing: 0.5px; line-height: 24px;">現代人重注養生，對於麵包的選擇，也會想要吃全麥製作的麵包；然而，根據董氏基金會調查發現，仍有很多麵包店並不是以全麥製作麵包，但是卻可能標示全麥。所以，民眾要買全麥麵包時，可得要張大眼，而且要學會如何分辨全麥麵包。 全麥麵包所含全麥應達到51% 全麥麵包所含成分必須含胚芽、胚乳、麩皮達到51%，才能稱之為全麥麵包；但是，很多業者並未達到此比例。董氏基金會食品營養組主任許惠玉表示，雖然之前曾建議食藥署，應該要針對全麥麵包進行稽查，但是目前仍然沒有進行管理，使得市面上販售的全麥麵包還有很多是不合格的。 外觀會有小黑點 至於該如何分辨是否為全麥麵包？許惠玉主任指出，麵包是以小麥製作為主，但是也有加入大麥或是胚牙米，如果是全麥麵包，從外觀看，麵包上會有很多小黑點，越密集的小黑點，所含全麥的量越高，而且全麥麵包所含的油脂與糖不可太多。 重量較重且紮實 另外，全麥麵包的重量也會比一般麵包的重量來得重；許惠玉主任進一步指出，全麥因為有麩皮，使得麵包的重量會比較重，拿在手上會感受到麵包很有份量，會比較紮實，而且麩皮越密，就會越重。 原文標題: 全麥麵包挑選有秘訣　專家教你這4招 原文網址：http://gotv.ctitv.com.tw/2016/04/195602.htm</span></p>\r\n', '2016-05-30 00:00:00', NULL, 1, '2016-06-30 12:45:50', '0000-00-00 00:00:00', 0, 1, NULL, NULL, NULL, NULL, NULL),
(5, 9, 1, NULL, '【元佬麵團宅配服務】購買滿3600元免運費!!', NULL, NULL, NULL, NULL, NULL, NULL, 'Simon Z總是指導元佬團隊成員說：「我們元佬的麵團堅持採以五穀雜糧為基底的老麵發酵技術製作麵團，絕不用化學添加物。我們的價值在於：技術團隊從發麵、攪麵、壓麵、拉麵、揉麵、發酵到蒸熟，每日都遵循這些完整工序，再加上手勢、掌根、掌心、虎口及手指力道和角度掌握得宜，故能確保麵團的絕佳口感。\r\n\r\n', '<p>\r\n <span style="color: rgb(81, 81, 81); font-family: Raleway, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 16px; letter-spacing: 0.5px; line-height: 24px;">訂購前請務必詳細閱讀下列注意事項以維護您的權益。1.若訂單金額超過三千元,請於三日前預約並享有免宅配運費之優惠。2.若欲當日下訂當日取貨,請於當日下午2點前訂購完畢。3.來店取貨最晚請於20:30前取貨。4.本店僅提供宅配寄送或到店取貨尚無提供外送服務5.元佬麵團保有接受訂單與否之最後權力即日起訂購元佬麵團商品滿3600元免運費,未滿3600元須付運費180元(每箱)，採用冷凍低溫宅配貨到付款訂購專線(02)2367-7888</span></p>\r\n<p>\r\n    <span style="color: rgb(81, 81, 81); font-family: Raleway, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 16px; letter-spacing: 0.5px; line-height: 24px;"><img alt="" src="/upload/images/po01.jpg" style="width: 654px; height: 919px;" /></span></p>\r\n', '2016-06-16 00:00:00', NULL, 1, '2016-06-30 12:48:39', '0000-00-00 00:00:00', 0, 1, NULL, NULL, NULL, NULL, NULL);
EOT;
        $query = $this->db->query($insert_sql);

        // Backadmin
        $insert_sql = <<<EOT
INSERT INTO `backadmin` (`id`, `webname`, `webtitle`, `keyword`, `description`, `email`, `copyright`, `tel`, `address`, `shipment`, `discount_shipment`, `discount_money`) VALUES
(1, '元佬麵團', '元佬麵團', '元佬麵團關鍵字', '元佬麵團描述', NULL, '2016. designed by 三田九實. All right reserved.', NULL, '', 100, 50, 500);
EOT;
        $query = $this->db->query($insert_sql);

        // Backmainmenu
        $insert_sql = <<<EOT
INSERT INTO `backmainmenu` (`id`, `name`, `link`, `listpage`, `insertpage`, `modifypage`, `recoverpage`, `typepage`, `showhide`, `admintype1_permission`, `admintype2_permission`, `admintype3_permission`, `sort`) VALUES
(1, '基本設定', 'page', 'list.php', 'insert.php', 'modify.php', '', '', 1, 1, 0, 1, 1),
(2, '後台管理員帳號', 'page', 'adminlist.php', 'admininsert.php', 'adminmodify.php', 'adminrecover.php', '', 1, 1, 0, 0, 7),
(3, '類別管理', 'page', 'typelist.php', 'typeinsert.php', 'typemodify.php', 'typerecover.php', '', 1, 1, 0, 0, 6),
(4, '媒體報導', 'page', 'bloglist.php', 'bloginsert.php', 'blogmodify.php', 'blogrecover.php', '', 1, 1, 0, 0, 15),
(5, '靜態頁面', 'page', 'staticlist.php', 'staticinsert.php', 'staticmodify.php', 'articlerecover.php', '', 1, 1, 0, 0, 19),
(6, '訂單管理', 'page', 'orderlist.php', 'orderinsert.php', 'ordermodify.php', 'orderrecover.php', '', 1, 1, 1, 0, 2),
(7, '會員管理', 'page', 'userlist.php', 'userinsert.php', 'usermodify.php', 'userrecover.php', '', 1, 1, 0, 0, 3),
(8, '首頁輪播', 'page', 'carouse_index_list.php', 'carouse_index_insert.php', 'carouse_index_modify.php', 'articlerecover.php', '', 1, 1, 0, 0, 12),
(9, '最新消息', 'page', 'newslist.php', 'newsinsert.php', 'newsmodify.php', 'articlerecover.php', '', 1, 1, 0, 0, 13),
(10, '活動下載', 'page', 'promotionslist.php', 'promotionsinsert.php', 'promotionsmodify.php', 'promotionsrecover.php', '', 1, 1, 0, 0, 16),
(11, '線上訂購', 'page', 'productlist.php', 'productinsert.php', 'productmodify.php', 'productrecover.php', 'update_excel.php', 1, 1, 0, 0, 14),
(12, '分店查詢', 'page', 'storelist.php', 'storeinsert.php', 'storemodify.php', 'storerecover.php', '', 1, 1, 0, 1, 17),
(13, '聯絡表單管理', 'page', 'contactuslist.php', '', '', 'articlerecover.php', '', 1, 1, 0, 0, 9),
(14, '訂單細項管理', 'page', 'orderlist.php', 'orderdetailinsert.php', 'orderdetailmodify.php', 'orderdetailrecover.php', '', 0, 1, 0, 1, 3),
(15, '元老傳承管理', 'page', 'staticlist.php', 'staticinsert.php', 'staticmodify.php', 'articlerecover.php', '', 1, 1, 0, 0, 18),
(16, '首頁彈跳視窗', 'page', 'special_offers_list.php', 'special_offers_insert.php', 'special_offers_modify.php', 'articlerecover.php', '', 1, 1, 0, 0, 11),
(17, '實體介面帳號', 'page', 'store_account_list.php', 'store_account_insert.php', 'store_account_modify.php', 'articlerecover.php', '', 1, 1, 0, 0, 8),
(18, '待審黃金區', 'page', 'verify_vip_list.php', 'verify_vip_insert.php', 'verify_vip_modify.php', 'articlerecover.php', '', 1, 1, 0, 0, 4),
(19, '生日禮兌換', 'page', 'birthdaylist.php', 'birthdayinsert.php', 'birthdaymodify.php', 'articlerecover.php', '', 1, 1, 0, 0, 5),
(20, '電子報', 'page', 'edmlist.php', 'edminsert.php', 'edmmodify.php', 'articlerecover.php', '', 1, 1, 0, 0, 10);
EOT;
        $query = $this->db->query($insert_sql);

        // Config
        $insert_sql = <<<EOT
INSERT INTO `config` (`setting`, `value`) VALUES
('attack_mitigation_time', '+30 minutes'),
('attempts_before_ban', '30'),
('attempts_before_verify', '5'),
('bcrypt_cost', '10'),
('cookie_domain', NULL),
('cookie_forget', '+30 minutes'),
('cookie_http', '0'),
('cookie_name', 'authID'),
('cookie_path', '/'),
('cookie_remember', '+1 month'),
('cookie_secure', '0'),
('emailmessage_suppress_activation', '0'),
('emailmessage_suppress_reset', '0'),
('ite_password_reset_page', 'reset'),
('password_min_score', '3'),
('request_key_expiration', '+10 minutes'),
('site_activation_page', 'activate'),
('site_email', 'catxii@gmail.com'),
('site_key', 'fghuior.)/!/jdUkd8s2!7HVHG7777ghg'),
('site_name', '元佬麵團'),
('site_timezone', 'Asia/Taipei'),
('site_url', 'https://github.com/PHPAuth/PHPAuth'),
('smtp', '1'),
('smtp_auth', '1'),
('smtp_host', 'smtp.gmail.com'),
('smtp_password', '5j4zj6su3'),
('smtp_port', '465'),
('smtp_security', 'ssl'),
('smtp_username', 'falcoinno.email@gmail.com'),
('table_attempts', 'attempts'),
('table_requests', 'requests'),
('table_sessions', 'sessions'),
('table_users', 'users'),
('verify_email_max_length', '100'),
('verify_email_min_length', '5'),
('verify_email_use_banlist', '1'),
('verify_password_min_length', '6');
EOT;
        $query = $this->db->query($insert_sql);


        // image
        $insert_sql = <<<EOT
INSERT INTO `image` (`id`, `panel`, `source_id`, `file_timestamp`, `thumbnailUrl`, `url`, `deleteUrl`, `file_type`, `file_name`, `file_size`, `file_number`, `recover`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 1467259775, 'http://young.falcoinno.com/assert/files/files/thumbnail/b2.jpg', 'http://young.falcoinno.com/assert/files/files/b2.jpg', 'http://young.falcoinno.com/assert/files/index.php?file=b2.jpg', 'image/jpeg', 'b2.jpg', 742556, 0, 0, '2016-06-30 12:09:41', NULL),
(2, 11, 4, 1467260394, 'http://young.falcoinno.com/assert/files/files/thumbnail/m01.png', 'http://young.falcoinno.com/assert/files/files/m01.png', 'http://young.falcoinno.com/assert/files/index.php?file=m01.png', 'image/png', 'm01.png', 175781, 0, 0, '2016-06-30 12:20:37', NULL),
(3, 11, 3, 1467260441, 'http://young.falcoinno.com/assert/files/files/thumbnail/m02.png', 'http://young.falcoinno.com/assert/files/files/m02.png', 'http://young.falcoinno.com/assert/files/index.php?file=m02.png', 'image/png', 'm02.png', 210529, 0, 0, '2016-06-30 12:21:19', NULL),
(4, 12, 1, 1467261141, 'http://young.falcoinno.com/assert/files/files/thumbnail/shop1_converted.jpg', 'http://young.falcoinno.com/assert/files/files/shop1_converted.jpg', 'http://young.falcoinno.com/assert/files/index.php?file=shop1_converted.jpg', 'image/jpeg', 'shop1_converted.jpg', 38807, 0, 0, '2016-06-30 12:33:53', NULL),
(5, 4, 4, 1467261840, 'http://young.falcoinno.com/assert/files/files/thumbnail/b39.jpg', 'http://young.falcoinno.com/assert/files/files/b39.jpg', 'http://young.falcoinno.com/assert/files/index.php?file=b39.jpg', 'image/jpeg', 'b39.jpg', 224301, 0, 0, '2016-06-30 12:45:48', NULL),
(6, 9, 5, 1467262025, 'http://young.falcoinno.com/assert/files/files/thumbnail/im2.JPG', 'http://young.falcoinno.com/assert/files/files/im2.JPG', 'http://young.falcoinno.com/assert/files/index.php?file=im2.JPG', 'image/jpeg', 'im2.JPG', 458475, 0, 0, '2016-06-30 12:47:41', NULL);
EOT;
        $query = $this->db->query($insert_sql);


        // migrations
        $insert_sql = <<<EOT
INSERT INTO `migrations` (`version`) VALUES
(20160620171000);
EOT;
        $query = $this->db->query($insert_sql);


        // Product
        $insert_sql = <<<EOT
INSERT INTO `product` (`id`, `panel`, `type`, `number`, `kind`, `name`, `pic`, `pay_method`, `transport_method`, `visitor`, `description`, `content`, `start_at`, `end_at`, `created_at`, `updated_at`, `recover`, `sort`, `show`, `hot`, `price`, `special_offer`, `qty`) VALUES
(1, 11, 11, 0, 1, '(訂製專區) 白色免螺絲角鋼 收納層架櫃專用', NULL, ' 銀行或郵局轉帳，貨到付款', '貨運/宅配', 0, NULL, '<p>\r\n   <img alt="" class="m_bottom_13" src="../../public/site/images/p_image1.png" /> <img alt="" class="m_bottom_13" src="../../public/site/images/p_image2_else.jpg" /></p>\r\n<p class="second_font m_bottom_13">\r\n   ★白色免螺絲 角鋼 為A.項商品</p>\r\n<p>\r\n <img alt="" class="m_bottom_13" src="../../public/site/images/p_image3_else.jpg" /> <img alt="" class="m_bottom_13" src="../../public/site/images/p_image4_else.gif" /> <img alt="" class="m_bottom_13" src="../../public/site/images/p_image5_else.jpg" /> <img alt="" class="m_bottom_13" src="../../public/site/images/p_image6_else.jpg" /> <img alt="" class="m_bottom_13" src="../../public/site/images/p_image7_else.jpg" /></p>\r\n<p class="second_font m_bottom_13">\r\n  ★在運送或自行組裝過程中，難免會有些許脫漆情形 若有以上情形皆屬正常現象</p>\r\n<p class="second_font m_bottom_13">\r\n 角鋼估價請複製:</p>\r\n<p class="second_font m_bottom_13">\r\n 白色免螺絲 角鋼：<br />\r\n 長＿尺，高＿尺，深＿尺，共＿層(每層補強＿支)<br />\r\n   附＿mm木板，木板種類＿，總共＿座<br />\r\n 運送至＿縣市＿鄉鎮</p>\r\n<p class="second_font m_bottom_13">\r\n    個人因素退貨，買家須自付退貨商品寄回郵資；退款金額將不含商品寄回郵資 ，敬請見諒！</p>\r\n<p class="second_font m_bottom_13">\r\n    有任何問題或不了解的地方都歡迎發問！！</p>\r\n<p>\r\n  <img alt="" class="m_bottom_13" src="../../public/site/images/p_image8_else.gif" /> <img alt="" class="m_bottom_13" src="../../public/site/images/p_image9_else.jpg" /></p>\r\n<p class="second_font m_bottom_13">\r\n  萬能角鋼、免螺絲角鋼、鋁合金架、狗籠、各式不鏽鋼、角鋼架、免螺絲角鋼架<br />\r\n   台南角鋼、角鋼購買詢問、角鋼施工規劃、各種角鋼設計款式</p>\r\n<p class="second_font m_bottom_13">\r\n  Rivet Shelving, also known as Rivet rack,<br />\r\n angle steel, wide span rack, double rivet shelving, double rivet boltless shelving,<br />\r\n   speedibilt or rivet shelving is becoming a very popular type of shelving or rack style.</p>\r\n<p>\r\n  <img alt="" class="m_bottom_13" src="../../public/site/images/p_image10_else.jpg" /></p>\r\n', NULL, NULL, '2016-05-19 13:05:48', '0000-00-00 00:00:00', 1, 1, 1, 0, '1302', '1102', '3'),
(2, 11, 3, 0, 2, '原味(無糖)', NULL, '', '', 0, '<p>\r\n    每包：6入</p>\r\n<p>\r\n    重量：350克</p>\r\n<p>\r\n  葷素：皆可</p>\r\n<p>\r\n    配方：台灣小麥粉、熱水、上白糖、鹽、脫脂奶粉、濕酵母、依思妮鮮奶油、無鹽發酵奶油、小麥粒(煮過)</p>\r\n<p>\r\n 熱量：150大卡(每入)</p>\r\n', '<h4>\r\n    溫 馨 提 醒</h4>\r\n<p>\r\n 保存方法：冷藏:可保存3天。 冷凍:可保存3個星期。(建議使用,因冷凍會hold住 水份,老麵團不易變乾硬) 如何吃到最佳口感的老麵饅頭包子？</p>\r\n<p>\r\n  ◆用電鍋蒸:1.電鍋放一杯量的水。(視蒸饅頭數而定) 2.時間到開關跳起來後,即可取出食用。 ※請勿持續放置電鍋內保溫,否則老麵團水份會被吸乾, 外皮會越放越乾硬。</p>\r\n<p>\r\n   ◆用鍋子隔水加熱: 1.鍋子加水。 2.大火蒸煮數分鐘到饅頭變軟熱即可食用。 (冷凍饅頭水滾後蒸約8分鐘,冷藏饅頭水滾後蒸約5分鐘) ※不建議使用微波爐或烤箱加熱,會使老麵團變乾硬,口感不佳。</p>\r\n', NULL, NULL, '2016-06-24 17:31:51', '2016-06-30 11:49:41', 0, 1, 1, 0, '2000', '1200', '100'),
(3, 11, 3, 0, 1, '全麥無糖', NULL, '', '', 0, '<p>\r\n  每包：6入</p>\r\n<p>\r\n    重量：350克</p>\r\n<p>\r\n  葷素：皆可</p>\r\n<p>\r\n    配方：台灣小麥粉、熱水、上白糖、鹽、脫脂奶粉、濕酵母、依思妮鮮奶油、無鹽發酵奶油、小麥粒(煮過)</p>\r\n<p>\r\n 熱量：150大卡(每入)</p>\r\n', '<h4>\r\n    溫 馨 提 醒</h4>\r\n<p>\r\n 保存方法：冷藏:可保存3天。 冷凍:可保存3個星期。(建議使用,因冷凍會hold住 水份,老麵團不易變乾硬) 如何吃到最佳口感的老麵饅頭包子？</p>\r\n<p>\r\n  ◆用電鍋蒸:1.電鍋放一杯量的水。(視蒸饅頭數而定) 2.時間到開關跳起來後,即可取出食用。 ※請勿持續放置電鍋內保溫,否則老麵團水份會被吸乾, 外皮會越放越乾硬。</p>\r\n<p>\r\n   ◆用鍋子隔水加熱: 1.鍋子加水。 2.大火蒸煮數分鐘到饅頭變軟熱即可食用。 (冷凍饅頭水滾後蒸約8分鐘,冷藏饅頭水滾後蒸約5分鐘) ※不建議使用微波爐或烤箱加熱,會使老麵團變乾硬,口感不佳。</p>\r\n', NULL, NULL, '2016-06-24 17:31:51', '2016-06-30 12:21:21', 0, 2, 1, 0, '54', '123', '100'),
(4, 11, 3, 0, 3, '原味(無糖)', NULL, '', '', 0, '<p>\r\n    每包：6入</p>\r\n<p>\r\n    重量：350克</p>\r\n<p>\r\n  葷素：皆可</p>\r\n<p>\r\n    配方：台灣小麥粉、熱水、上白糖、鹽、脫脂奶粉、濕酵母、依思妮鮮奶油、無鹽發酵奶油、小麥粒(煮過)</p>\r\n<p>\r\n 熱量：150大卡(每入)</p>\r\n', '<h4>\r\n    溫 馨 提 醒</h4>\r\n<p>\r\n 保存方法：冷藏:可保存3天。 冷凍:可保存3個星期。(建議使用,因冷凍會hold住 水份,老麵團不易變乾硬) 如何吃到最佳口感的老麵饅頭包子？</p>\r\n<p>\r\n  ◆用電鍋蒸:1.電鍋放一杯量的水。(視蒸饅頭數而定) 2.時間到開關跳起來後,即可取出食用。 ※請勿持續放置電鍋內保溫,否則老麵團水份會被吸乾, 外皮會越放越乾硬。</p>\r\n<p>\r\n   ◆用鍋子隔水加熱: 1.鍋子加水。 2.大火蒸煮數分鐘到饅頭變軟熱即可食用。 (冷凍饅頭水滾後蒸約8分鐘,冷藏饅頭水滾後蒸約5分鐘) ※不建議使用微波爐或烤箱加熱,會使老麵團變乾硬,口感不佳。</p>\r\n', NULL, NULL, '2016-06-24 17:31:51', '2016-06-30 12:20:39', 0, 3, 1, 0, '123', '54', '100');
EOT;
        $query = $this->db->query($insert_sql);


        // Static
        $insert_sql = <<<EOT
INSERT INTO `static` (`id`, `panel`, `lang`, `name`, `pic`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `description`, `content`, `updated_at`, `show`, `field1`, `field2`, `field3`, `field4`, `field5`) VALUES
(1, 5, 1, '加盟專區', '', '', '', '', '', '', NULL, '\r\n            <h3 style="text-align: center;">加盟招募籌備中，敬請撥打加盟專線：02-2367-7888</h3>\r\n            <br>\r\n            <br>\r\n            <br>\r\n            <br>\r\n', '2016-06-30 12:51:11', 1, NULL, NULL, NULL, NULL, NULL),
(2, 5, 1, '常見問題', '', '', '', '', '', '', NULL, '<h3>\r\n   常見問題：</h3>\r\n<p>\r\n   付款方式<br />\r\n  『元佬麵團網路購物』 使用安全的「歐付寶」金流系統，目前提供付款方式有兩種：<br />\r\n    <br />\r\n  1.【ATM轉帳】<br />\r\n 完成訂購流程後，系統會自動產出一組專屬匯款帳號，請在指定時間內完成轉帳即可。<br />\r\n    <br />\r\n  2.【線上刷卡】<br />\r\n  完成訂購流程後，系統會自動跳到刷卡頁面； 若刷卡失敗，此筆訂單會顯示付款失敗，將會自動取消訂單，您必須要重新操作購物流程。(如遇同一張信用卡一直刷卡不過的情形，建議請立即與您的信用卡公司聯繫，並更換其他張信用卡刷卡，或將付款方式改為貨到付款或是ATM轉帳。)<br />\r\n <br />\r\n  付款成功後，將會收到系統發出的「付款成功-通知信」，即完成付款流程。<br />\r\n    <br />\r\n  ※ 我們不會主動連絡客戶分期付款，請小心詐騙。<br />\r\n   <br />\r\n  <br />\r\n  運費計算<br />\r\n  <br />\r\n  1.單筆訂單滿999元享免運優惠；未滿999元運費酌收80元。(外島地區運費一律200元)<br />\r\n <br />\r\n  2.完成訂購後，若要另外加購享同筆運費，請盡快與我們連繫。<br />\r\n <br />\r\n  備註：若直接下單，系統則會產生二次運費。<br />\r\n  <br />\r\n  <br />\r\n  配送方式<br />\r\n  <br />\r\n  1.目前提供「宅配送到指定地址」與「便利商店取件」兩種服務，<br />\r\n    <br />\r\n  2.今天下單，隔日出貨，一般為1~2天即可收到。<br />\r\n  <br />\r\n  ※ 例假日順延。<br />\r\n  <br />\r\n  <br />\r\n  其他問題<br />\r\n  ● 產品的商品保存期限?<br />\r\n  依產品不同，包裝上標示製造日期與保存期限。<br />\r\n <br />\r\n  ● 所有產品都有分葷素嗎？<br />\r\n 是的，您可查閱線上訂購產品頁面標示。<br />\r\n    <!-- <h5 class="title-ct">資料待提供</h5> --><!-- <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et.</p>\r\n                        <div class="block-contactinfo">\r\n                            <h6>G2F</h6>\r\n                            <p>客服專線  : 02-8792-2770<br>\r\n\r\n傳真  : 02-8792-2110<br>\r\n\r\nE-mail : g2fscs@g2fgroup.net<br>\r\n\r\n地址  : 114 台北市內湖區石潭路 27 號</p>\r\n                        </div>\r\n                        <div class="block-contactinfo">\r\n                            <h6>BENZ HEADQUATER</h6>\r\n                            <p>PO Box 16122 Collins Street West<br>\r\n                            Victoria 8007<br>\r\n                            Australia</p>\r\n                        </div> --></p>\r\n', '2016-06-17 21:19:59', 1, NULL, NULL, NULL, NULL, NULL),
(3, 5, 1, '人才招募', '', '', '', '', '', '', NULL, '<h3>\r\n   職務說明</h3>\r\n<h5>\r\n   工作內容：</h5>\r\n<p>\r\n   1、具備服務技巧相關經驗，有承擔力、執行力、口才技巧兼備。<br />\r\n 2、須對食品有興趣，願意不斷充實提升自己。<br />\r\n 3、劇本基本知識與技能，進而提升全員士氣達到績效。<br />\r\n 4、部門人才招募，新人教育訓練。<br />\r\n  5、參與公司經營策略，產品行銷策略等工作。</p>\r\n<p>\r\n    &nbsp;</p>\r\n<h5>\r\n  職務類別：</h5>\r\n<p>\r\n   櫃台收銀人員/外場服務人員</p>\r\n<p>\r\n    &nbsp;</p>\r\n<h5>\r\n  需求人數：</h5>\r\n<p>\r\n   2人</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  薪資待遇：</h5>\r\n<p>\r\n   面議</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  工作性質：</h5>\r\n<p>\r\n   全職</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  身份類別：</h5>\r\n<p>\r\n   一般求職者、中高齡者、二度就業</p>\r\n<p>\r\n  &nbsp;</p>\r\n<h5>\r\n  是否出差：</h5>\r\n<p>\r\n   不需出差/外派</p>\r\n<p>\r\n  &nbsp;</p>\r\n<h5>\r\n  管理責任：</h5>\r\n<p>\r\n   管理1-3人</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  可上班日：</h5>\r\n<p>\r\n   不限</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  休假制度：</h5>\r\n<p>\r\n   週休二日</p>\r\n<p>\r\n &nbsp;</p>\r\n<h5>\r\n  上班時段：</h5>\r\n<p>\r\n   日班 上班時段：09:00/下班時段: 18:00</p>\r\n<p>\r\n    &nbsp;</p>\r\n<h5>\r\n  上班地點：</h5>\r\n<p>\r\n   台北市和平東路二段18-9號</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  工作經驗：</h5>\r\n<p>\r\n   1年以上</p>\r\n<p>\r\n &nbsp;</p>\r\n<h5>\r\n  學歷要求：</h5>\r\n<p>\r\n   不拘</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  語文條件：</h5>\r\n<p>\r\n   不拘</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  方言條件：</h5>\r\n<p>\r\n   台語 : 很好</p>\r\n<p>\r\n  &nbsp;</p>\r\n<h5>\r\n  擅長工具：</h5>\r\n<p>\r\n   Word、Excel</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  工作技能：</h5>\r\n<p>\r\n   不拘</p>\r\n<p>\r\n   &nbsp;</p>\r\n<h5>\r\n  其他條件：</h5>\r\n<p>\r\n   職缺特色<br />\r\n  週休二日準時上下班提供加班費獎金分紅機制<br />\r\n  應徵方式</p>\r\n<p>\r\n &nbsp;</p>\r\n<h5>\r\n  職務聯絡人：</h5>\r\n<p>\r\n  張小姐</p>\r\n<p>\r\n  &nbsp;</p>\r\n<h5>\r\n  電　　　洽：</h5>\r\n<p>\r\n  (02)XXXXXXX<br />\r\n   其他應徵方式及備註：<br />\r\n    請先來電預約面試時間，勿直接前來，謝謝。<br />\r\n  &nbsp;</p>\r\n', '2016-06-17 21:21:00', 1, NULL, NULL, NULL, NULL, NULL),
(4, 16, 1, '優惠管理', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <img alt="" src="/upload/images/event.jpg" style="width: 800px;" /></div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          &nbsp;</li>\r\n </ul>\r\n</div>\r\n', '2016-06-30 12:15:06', 1, '元佬夏季週一麵包日(7/1~7/31) 麵包 85 折', '/index.php/site/news', NULL, NULL, NULL),
(5, 20, 1, '電子報', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n    <span class="watch-time-text" style="margin: 0px; padding: 0px; border: 0px; vertical-align: middle; background: transparent;">2014年8月25日发布</span></div>\r\n<div id="watch-description-text" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n  <p id="eow-description" style="margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n       Get Jessie J + Ariana Grande + Nicki Minaj &quot;Bang Bang&quot; now!&nbsp;<a class="yt-uix-servicelink " data-servicelink="CC8Q6TgiEwiem4Hw87XNAhUX2VgKHeTTCcMo-B0" data-url="http://smarturl.it/JSJSweetTalkerdlxDA" href="http://smarturl.it/JSJSweetTalkerdlxDA" rel="nofollow" style="margin: 0px; padding: 0px; border: 0px; color: rgb(22, 122, 198); cursor: pointer; text-decoration: none; background: transparent;" target="_blank">http://smarturl.it/JSJSweetTalkerdlxDA</a></p>\r\n</div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li class="watch-meta-item yt-uix-expander-body" style="margin: 0px; padding: 0px; border: 0px; clear: both; background: transparent;">\r\n         <h4 class="title" style="margin: 0px 10px 5px 0px; padding: 0px; border: 0px; font-weight: 500; font-size: 11px; line-height: 11px; float: left; width: 100px; background: transparent;">\r\n               类别</h4>\r\n         <ul class="content watch-info-tag-list" style="list-style: none; margin: 0px 0px 5px; padding: 0px; border: 0px; font-size: 11px; line-height: 11px; background: transparent;">\r\n             <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n                  <a class="g-hovercard yt-uix-sessionlink      spf-link " data-sessionlink="ei=e4NnV97xEpey4wLkp6eYDA" data-ytid="UC-9-kyTW8ZkZNDHQJ6FgpwQ" href="https://www.youtube.com/channel/UC-9-kyTW8ZkZNDHQJ6FgpwQ" style="margin: 0px; padding: 0px; border: 0px; color: rgb(22, 122, 198); cursor: pointer; text-decoration: none; white-space: nowrap; background: transparent;">音乐</a></li>\r\n          </ul>\r\n       </li>\r\n       <li class="watch-meta-item yt-uix-expander-body" style="margin: 0px; padding: 0px; border: 0px; clear: both; background: transparent;">\r\n         <h4 class="title" style="margin: 0px 10px 5px 0px; padding: 0px; border: 0px; font-weight: 500; font-size: 11px; line-height: 11px; float: left; width: 100px; background: transparent;">\r\n               许可</h4>\r\n         <ul class="content watch-info-tag-list" style="list-style: none; margin: 0px 0px 5px; padding: 0px; border: 0px; font-size: 11px; line-height: 11px; background: transparent;">\r\n             <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n                  标准YouTube许可</li>\r\n            </ul>\r\n       </li>\r\n       <li class="watch-meta-item yt-uix-expander-body" style="margin: 0px; padding: 0px; border: 0px; clear: both; background: transparent;">\r\n         <h4 class="title" style="margin: 0px 10px 5px 0px; padding: 0px; border: 0px; font-weight: 500; font-size: 11px; line-height: 11px; float: left; width: 100px; background: transparent;">\r\n               音乐</h4>\r\n         <ul class="content watch-info-tag-list" style="list-style: none; margin: 0px 0px 5px; padding: 0px; border: 0px; font-size: 11px; line-height: 11px; background: transparent;">\r\n             <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n                  Bang Bang - 来自<a class="g-hovercard yt-uix-sessionlink      spf-link " data-sessionlink="ei=e4NnV97xEpey4wLkp6eYDA" data-ytid="UCFIwgbSgHjfiK8mz7VE0g7Q" href="https://www.youtube.com/channel/UCFIwgbSgHjfiK8mz7VE0g7Q" style="margin: 0px; padding: 0px; border: 0px; color: rgb(22, 122, 198); cursor: pointer; text-decoration: none; white-space: nowrap; background: transparent;">Jessie J, Ariana Grande &amp; Nicki Minaj</a>&nbsp;(<a class="yt-uix-sessionlink " data-sessionlink="ei=e4NnV97xEpey4wLkp6eYDA" data-url="https://www.youtube.com/cthru?c2b=itunes&amp;version=2&amp;v=0HDdjwpPM3Y&amp;key=AE_82TeId6GrOTa0_yWdXn9voK32wuer12VMoAZ32JePPN2hXbhTLxFHBrsn86jknTb6-GtO-_LluMTGVLxlvyhJL5Tx_Rs0gR6lMgqCYoQCjhOC1osFBSfPolSjazjrKAklfyIyMtjIo6xOzN3XFnhYbgYqax7RYf3q1Zu_QQglzIlMVM4xZ_h3tyzgNXNz3FuMcLtp2JUL" href="https://www.youtube.com/cthru?c2b=itunes&amp;version=2&amp;v=0HDdjwpPM3Y&amp;key=AE_82TeId6GrOTa0_yWdXn9voK32wuer12VMoAZ32JePPN2hXbhTLxFHBrsn86jknTb6-GtO-_LluMTGVLxlvyhJL5Tx_Rs0gR6lMgqCYoQCjhOC1osFBSfPolSjazjrKAklfyIyMtjIo6xOzN3XFnhYbgYqax7RYf3q1Zu_QQglzIlMVM4xZ_h3tyzgNXNz3FuMcLtp2JUL" style="margin: 0px; padding: 0px; border: 0px; color: rgb(22, 122, 198); cursor: pointer; text-decoration: none; white-space: nowrap; background: transparent;">iTunes</a>)</li>\r\n         </ul>\r\n       </li>\r\n       <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          <ul style="box-sizing: border-box; margin: 0px; padding: 0px; color: rgb(81, 81, 81); font-family: Raleway, sans-serif; font-size: 16px; letter-spacing: 0.5px; line-height: 24px;">\r\n                <li style="box-sizing: border-box; list-style: none; position: relative; display: inline-block; text-transform: uppercase; font-size: 13px; padding: 30px 20px; float: left;">\r\n                  <a href="http://localhost:8888/young/index.php/site/member" style="box-sizing: border-box; color: rgb(84, 52, 52); text-decoration: none; transition: all 0.3s ease 0s; display: inline-block; position: relative; float: left; overflow: hidden; background-color: transparent;">會員專區</a></li>\r\n             <li class="bz-mini-cart" style="box-sizing: border-box; list-style: none; position: relative; display: inline-block; text-transform: uppercase; font-size: 13px; padding: 30px 12px; float: left;">\r\n                 <a href="http://localhost:8888/young/index.php/site/cart" style="box-sizing: border-box; color: rgb(84, 52, 52); text-decoration: none; transition: all 0.3s ease 0s; display: inline-block; position: relative; float: left; overflow: inherit; font-size: 20px; background-color: transparent;"><span class="count" style="box-sizing: border-box; width: 16px; height: 16px; border-radius: 50%; color: rgb(255, 255, 255); font-size: 11px; line-height: 16px; text-align: center; display: inline-block; position: absolute; top: -10px; right: -10px; background-color: rgb(225, 87, 26);">2</span></a></li>\r\n              <li class="bz-search-icon" style="box-sizing: border-box; list-style: none; position: relative; display: inline-block; text-transform: uppercase; font-size: 13px; padding: 30px 0px 30px 12px; float: left;">\r\n                  &nbsp;</li>\r\n         </ul>\r\n       </li>\r\n   </ul>\r\n</div>\r\n', '2016-06-20 13:51:41', 1, '電子報', NULL, NULL, NULL, NULL),
(6, 15, 1, '訂購方式', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <img alt="" src="/upload/images/event.jpg" style="width: 800px;" /></div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          &nbsp;</li>\r\n </ul>\r\n</div>\r\n', '2016-06-30 12:15:06', 1, '元佬夏季週一麵包日(7/1~7/31) 麵包 85 折', '/index.php/site/news', NULL, NULL, NULL),
(7, 15, 1, '烹調秘訣', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <img alt="" src="/upload/images/event.jpg" style="width: 800px;" /></div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          &nbsp;</li>\r\n </ul>\r\n</div>\r\n', '2016-06-30 12:15:06', 1, '元佬夏季週一麵包日(7/1~7/31) 麵包 85 折', '/index.php/site/news', NULL, NULL, NULL),
(8, 15, 1, '產品知識', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <img alt="" src="/upload/images/event.jpg" style="width: 800px;" /></div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          &nbsp;</li>\r\n </ul>\r\n</div>\r\n', '2016-06-30 12:15:06', 1, '元佬夏季週一麵包日(7/1~7/31) 麵包 85 折', '/index.php/site/news', NULL, NULL, NULL),
(9, 15, 1, '健康新知', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <img alt="" src="/upload/images/event.jpg" style="width: 800px;" /></div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          &nbsp;</li>\r\n </ul>\r\n</div>\r\n', '2016-06-30 12:15:06', 1, '元佬夏季週一麵包日(7/1~7/31) 麵包 85 折', '/index.php/site/news', NULL, NULL, NULL),
(10, 15, 1, 'FAQ', '', '', '', '', '', '', NULL, '<div id="watch-uploader-info" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <img alt="" src="/upload/images/event.jpg" style="width: 800px;" /></div>\r\n<div id="watch-description-extras" style="margin: 8px 0px 0px; padding: 0px; border: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, arial, sans-serif; line-height: 17px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">\r\n   <ul class="watch-extras-section" style="list-style: none; margin: 0px; padding: 0px; border: 0px; background: transparent;">\r\n        <li style="margin: 0px; padding: 0px; border: 0px; display: inline; background: transparent;">\r\n          &nbsp;</li>\r\n </ul>\r\n</div>\r\n', '2016-06-30 12:15:06', 1, '元佬夏季週一麵包日(7/1~7/31) 麵包 85 折', '/index.php/site/news', NULL, NULL, NULL);
EOT;
        $query = $this->db->query($insert_sql);


        // store
        $insert_sql = <<<EOT
INSERT INTO `store` (`id`, `panel`, `lang`, `type`, `name`, `pic`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `description`, `content`, `start_at`, `end_at`, `show`, `created_at`, `updated_at`, `recover`, `sort`, `field1`, `field2`, `field3`, `field4`, `field5`) VALUES
(1, 12, 1, NULL, '和平店', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>\r\n  <img alt="" src="/upload/images/A1_01_02.jpg" style="width: 600px; height: 400px;" /><br />\r\n <br />\r\n  <br />\r\n  <img alt="" src="/upload/images/A1_01_01.jpg" style="width: 600px; height: 400px;" /></p>\r\n<p>\r\n    <br />\r\n  <iframe allowfullscreen="" frameborder="0" height="600" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3615.248902329621!2d121.5339313143131!3d25.025625844782613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a987704ba031%3A0xe734d5a677b13fb3!2zMTA25Y-w5YyX5biC5aSn5a6J5Y2A5ZKM5bmz5p2x6Lev5LqM5q61MTgtOeiZnw!5e0!3m2!1szh-TW!2stw!4v1461304731534" style="border:0" width="800"></iframe></p>\r\n', NULL, NULL, 1, '2016-06-20 19:04:25', '2016-06-30 12:41:45', 0, 1, '特色介紹/交通方式', NULL, NULL, NULL, NULL);
EOT;
        $query = $this->db->query($insert_sql);


        // store_account
        $insert_sql = <<<EOT
INSERT INTO `store_account` (`id`, `name`, `acc`, `pwd`, `store`, `token`, `login_time`, `time`, `right`, `Recover`) VALUES
(1, 'ianlin', 'catxii', '25f9e794323b453885f5181f1b624d0b', '1', NULL, NULL, '2016-06-20', 1, 0);
EOT;
        $query = $this->db->query($insert_sql);


        // Type
        $insert_sql = <<<EOT
INSERT INTO `type` (`id`, `panel`, `parent_id`, `name`, `name_en`, `created_at`, `updated_at`, `sort`, `recover`) VALUES
(1, 3, 0, '產品管理', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(2, 3, 0, '媒體報導', '', '0000-00-00 00:00:00', '2016-04-21 10:27:18', 0, 0),
(3, 3, 1, '德國麵團系列', '', '0000-00-00 00:00:00', '2016-04-21 10:27:18', 0, 0),
(4, 3, 1, '特級麵團系列', '', '0000-00-00 00:00:00', '2016-04-21 10:27:18', 0, 0),
(5, 3, 1, '飲品系列', '', '0000-00-00 00:00:00', '2016-04-21 10:27:18', 0, 0),
(6, 3, 1, '咖啡系列', '', '0000-00-00 00:00:00', '2016-04-21 10:27:18', 0, 0),
(7, 3, 1, '有機飲品', '', '0000-00-00 00:00:00', '2016-05-19 13:00:28', 0, 0),
(8, 3, 2, '電視報導', '', '0000-00-00 00:00:00', '2016-05-19 13:00:28', 0, 0),
(9, 3, 2, '平面報導', '', '0000-00-00 00:00:00', '2016-05-19 13:00:28', 0, 0),
(10, 3, 2, '網路媒體', '', '0000-00-00 00:00:00', '2016-05-19 13:00:28', 0, 0);

EOT;
        $query = $this->db->query($insert_sql);



        // User
        $pw1='$2y$10$Ldy3OWVlZxGOo6k1QXMZy.cRxBHAgxwRlWAJRFV3VYy4tiV14O69q';
        $insert_sql = <<<EOT
INSERT INTO `users` (`id`, `email`, `account`, `password`, `name`, `phone`, `identity`, `address`, `birthday`, `member_level`, `verify`, `verify_number`, `register_from`, `gold`, `bonus`, `bir_gift`, `isactive`, `dt`, `updated_at`) VALUES
(1, 'catxii@gmail.com', 'catxii', '$pw1', 'Ian Lin', '0975191507', 'A111111111', '基隆市中山區中和路', '2000-01-01', 0, 0, 0, '0', 0, 0, 0, 1, '2016-05-17 20:21:13', '2016-05-18 04:21:13'),
(2, 'aaa@gmail.com', 'aaa', '$pw1', 'Lin', '0975191507', 'A111111111', '基隆市中山區中和路', '2000-06-01', 0, 0, 0, '0', 0, 0, 0, 1, '2016-05-17 20:21:13', '2016-05-18 04:21:13');
EOT;
        $query = $this->db->query($insert_sql);


    }
}