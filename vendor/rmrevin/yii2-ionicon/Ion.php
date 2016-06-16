<?php
/**
 * Ion.php
 * @author Revin Roman
 * @link https://rmrevin.com
 */

namespace rmrevin\yii\ionicon;

/**
 * Class Ion
 * @package rmrevin\yii\ionicon
 */
class Ion extends Ionicon
{

    /** @var string CSS Class prefix */
    public static $cssPrefix = 'ion';

    /**
     * Get all icon constants for dropdown list in example
     * @param bool $html whether to render icon as array value prefix
     * @return array
     */
    public static function getConstants($html = false)
    {
        $result = [];
        foreach ((new \ReflectionClass(get_class()))->getConstants() as $constant) {
            $key = static::$cssPrefix . '-' . $constant;

            $result[$key] = ($html)
                ? static::icon($constant) . '&nbsp;&nbsp;' . $constant
                : $constant;
        }
        return $result;
    }

    const _IONIC = 'ionic';
    const _ARROW_UP_A = 'arrow-up-a';
    const _ARROW_RIGHT_A = 'arrow-right-a';
    const _ARROW_DOWN_A = 'arrow-down-a';
    const _ARROW_LEFT_A = 'arrow-left-a';
    const _ARROW_UP_B = 'arrow-up-b';
    const _ARROW_RIGHT_B = 'arrow-right-b';
    const _ARROW_DOWN_B = 'arrow-down-b';
    const _ARROW_LEFT_B = 'arrow-left-b';
    const _ARROW_UP_C = 'arrow-up-c';
    const _ARROW_RIGHT_C = 'arrow-right-c';
    const _ARROW_DOWN_C = 'arrow-down-c';
    const _ARROW_LEFT_C = 'arrow-left-c';
    const _ARROW_RETURN_RIGHT = 'arrow-return-right';
    const _ARROW_RETURN_LEFT = 'arrow-return-left';
    const _ARROW_SWAP = 'arrow-swap';
    const _ARROW_SHRINK = 'arrow-shrink';
    const _ARROW_EXPAND = 'arrow-expand';
    const _ARROW_MOVE = 'arrow-move';
    const _ARROW_RESIZE = 'arrow-resize';
    const _CHEVRON_UP = 'chevron-up';
    const _CHEVRON_RIGHT = 'chevron-right';
    const _CHEVRON_DOWN = 'chevron-down';
    const _CHEVRON_LEFT = 'chevron-left';
    const _NAVICON_ROUND = 'navicon-round';
    const _NAVICON = 'navicon';
    const _DRAG = 'drag';
    const _LOG_IN = 'log-in';
    const _LOG_OUT = 'log-out';
    const _CHECKMARK_ROUND = 'checkmark-round';
    const _CHECKMARK = 'checkmark';
    const _CHECKMARK_CIRCLED = 'checkmark-circled';
    const _CLOSE_ROUND = 'close-round';
    const _CLOSE = 'close';
    const _CLOSE_CIRCLED = 'close-circled';
    const _PLUS_ROUND = 'plus-round';
    const _PLUS = 'plus';
    const _PLUS_CIRCLED = 'plus-circled';
    const _MINUS_ROUND = 'minus-round';
    const _MINUS = 'minus';
    const _MINUS_CIRCLED = 'minus-circled';
    const _INFORMATION = 'information';
    const _INFORMAT_CIRCLED = 'information-circled';
    const _HELP = 'help';
    const _HELP_CIRCLED = 'help-circled';
    const _BACKSPACE_OUTLINE = 'backspace-outline';
    const _BACKSPACE = 'backspace';
    const _HELP_BUOY = 'help-buoy';
    const _ASTERISK = 'asterisk';
    const _ALERT = 'alert';
    const _ALERT_CIRCLED = 'alert-circled';
    const _REFRESH = 'refresh';
    const _LOOP = 'loop';
    const _SHUFFLE = 'shuffle';
    const _HOME = 'home';
    const _SEARCH = 'search';
    const _FLAG = 'flag';
    const _STAR = 'star';
    const _HEART = 'heart';
    const _HEART_BROKEN = 'heart-broken';
    const _GEAR_A = 'gear-a';
    const _GEAR_B = 'gear-b';
    const _TOGGLE_FILLED = 'toggle-filled';
    const _TOGGLE = 'toggle';
    const _SETTINGS = 'settings';
    const _WRENCH = 'wrench';
    const _HAMMER = 'hammer';
    const _EDIT = 'edit';
    const _TRASH_A = 'trash-a';
    const _TRASH_B = 'trash-b';
    const _DOCUMENT = 'document';
    const _DOCUMENT_TEXT = 'document-text';
    const _CLIPBOARD = 'clipboard';
    const _SCISSORS = 'scissors';
    const _FUNNEL = 'funnel';
    const _BOOKMARK = 'bookmark';
    const _EMAIL = 'email';
    const _EMAIL_UNREAD = 'email-unread';
    const _FOLDER = 'folder';
    const _FILING = 'filing';
    const _ARCHIVE = 'archive';
    const _REPLY = 'reply';
    const _REPLY_ALL = 'reply-all';
    const _FORWARD = 'forward';
    const _SHARE = 'share';
    const _PAPER_AIRPLANE = 'paper-airplane';
    const _LINK = 'link';
    const _PAPERCLIP = 'paperclip';
    const _COMPOSE = 'compose';
    const _BRIEFCASE = 'briefcase';
    const _MEDKIT = 'medkit';
    const _AT = 'at';
    const _POUND = 'pound';
    const _QUOTE = 'quote';
    const _CLOUD = 'cloud';
    const _UPLOAD = 'upload';
    const _MORE = 'more';
    const _GRID = 'grid';
    const _CALENDAR = 'calendar';
    const _CLOCK = 'clock';
    const _COMPASS = 'compass';
    const _PINPOINT = 'pinpoint';
    const _PIN = 'pin';
    const _NAVIGATE = 'navigate';
    const _LOCATION = 'location';
    const _MAP = 'map';
    const _LOCK_COMBINATION = 'lock-combination';
    const _LOCKED = 'locked';
    const _UNLOCKED = 'unlocked';
    const _KEY = 'key';
    const _ARROW_GRAPH_UP_RIGHT = 'arrow-graph-up-right';
    const _ARROW_GRAPH_DOWN_RIGHT = 'arrow-graph-down-right';
    const _ARROW_GRAPH_UP_LEFT = 'arrow-graph-up-left';
    const _ARROW_GRAPH_DOWN_LEFT = 'arrow-graph-down-left';
    const _STATS_BARS = 'stats-bars';
    const _CONNECT_BARS = 'connection-bars';
    const _PIE_GRAPH = 'pie-graph';
    const _CHATBUBBLE = 'chatbubble';
    const _CHATBUBBLE_WORKING = 'chatbubble-working';
    const _CHATBUBBLES = 'chatbubbles';
    const _CHATBOX = 'chatbox';
    const _CHATBOX_WORKING = 'chatbox-working';
    const _CHATBOXES = 'chatboxes';
    const _PERSON = 'person';
    const _PERSON_ADD = 'person-add';
    const _PERSON_STALKER = 'person-stalker';
    const _WOMAN = 'woman';
    const _MAN = 'man';
    const _FEMALE = 'female';
    const _MALE = 'male';
    const _TRANSGENDER = 'transgender';
    const _FORK = 'fork';
    const _KNIFE = 'knife';
    const _SPOON = 'spoon';
    const _SOUP_CAN_OUTLINE = 'soup-can-outline';
    const _SOUP_CAN = 'soup-can';
    const _BEER = 'beer';
    const _WINEGLASS = 'wineglass';
    const _COFFEE = 'coffee';
    const _ICECREAM = 'icecream';
    const _PIZZA = 'pizza';
    const _POWER = 'power';
    const _MOUSE = 'mouse';
    const _BATTERY_FULL = 'battery-full';
    const _BATTERY_HALF = 'battery-half';
    const _BATTERY_LOW = 'battery-low';
    const _BATTERY_EMPTY = 'battery-empty';
    const _BATTERY_CHARGING = 'battery-charging';
    const _WIFI = 'wifi';
    const _BLUETOOTH = 'bluetooth';
    const _CALCULATOR = 'calculator';
    const _CAMERA = 'camera';
    const _EYE = 'eye';
    const _EYE_DISABLED = 'eye-disabled';
    const _FLASH = 'flash';
    const _FLASH_OFF = 'flash-off';
    const _QR_SCANNER = 'qr-scanner';
    const _IMAGE = 'image';
    const _IMAGES = 'images';
    const _WAND = 'wand';
    const _CONTRAST = 'contrast';
    const _APERTURE = 'aperture';
    const _CROP = 'crop';
    const _EASEL = 'easel';
    const _PAINTBRUSH = 'paintbrush';
    const _PAINTBUCKET = 'paintbucket';
    const _MONITOR = 'monitor';
    const _LAPTOP = 'laptop';
    const _IPAD = 'ipad';
    const _IPHONE = 'iphone';
    const _IPOD = 'ipod';
    const _PRINTER = 'printer';
    const _USB = 'usb';
    const _OUTLET = 'outlet';
    const _BUG = 'bug';
    const _CODE = 'code';
    const _CODE_WORKING = 'code-working';
    const _CODE_DOWNLOAD = 'code-download';
    const _FORK_REPO = 'fork-repo';
    const _NETWORK = 'network';
    const _PULL_REQUEST = 'pull-request';
    const _MERGE = 'merge';
    const _XBOX = 'xbox';
    const _PLAYSTATION = 'playstation';
    const _STEAM = 'steam';
    const _CLOSED_CAPTIONING = 'closed-captioning';
    const _VIDEOCAMERA = 'videocamera';
    const _FILM_MARKER = 'film-marker';
    const _DISC = 'disc';
    const _HEADPHONE = 'headphone';
    const _MUSIC_NOTE = 'music-note';
    const _RADIO_WAVES = 'radio-waves';
    const _SPEAKERPHONE = 'speakerphone';
    const _MIC_A = 'mic-a';
    const _MIC_B = 'mic-b';
    const _MIC_C = 'mic-c';
    const _VOLUME_HIGH = 'volume-high';
    const _VOLUME_MEDIUM = 'volume-medium';
    const _VOLUME_LOW = 'volume-low';
    const _VOLUME_MUTE = 'volume-mute';
    const _LEVELS = 'levels';
    const _PLAY = 'play';
    const _PAUSE = 'pause';
    const _STOP = 'stop';
    const _RECORD = 'record';
    const _SKIP_FORWARD = 'skip-forward';
    const _SKIP_BACKWARD = 'skip-backward';
    const _EJECT = 'eject';
    const _BAG = 'bag';
    const _CARD = 'card';
    const _CASH = 'cash';
    const _PRICETAG = 'pricetag';
    const _PRICETAGS = 'pricetags';
    const _THUMBSUP = 'thumbsup';
    const _THUMBSDOWN = 'thumbsdown';
    const _HAPPY_OUTLINE = 'happy-outline';
    const _HAPPY = 'happy';
    const _SAD_OUTLINE = 'sad-outline';
    const _SAD = 'sad';
    const _BOWTIE = 'bowtie';
    const _TSHIRT_OUTLINE = 'tshirt-outline';
    const _TSHIRT = 'tshirt';
    const _TROPHY = 'trophy';
    const _PODIUM = 'podium';
    const _RIBBON_A = 'ribbon-a';
    const _RIBBON_B = 'ribbon-b';
    const _UNIVERSITY = 'university';
    const _MAGNET = 'magnet';
    const _BEAKER = 'beaker';
    const _ERLENMEYER_FLASK = 'erlenmeyer-flask';
    const _EGG = 'egg';
    const _EARTH = 'earth';
    const _PLANET = 'planet';
    const _LIGHTBULB = 'lightbulb';
    const _CUBE = 'cube';
    const _LEAF = 'leaf';
    const _WATERDROP = 'waterdrop';
    const _FLAME = 'flame';
    const _FIREBALL = 'fireball';
    const _BONFIRE = 'bonfire';
    const _UMBRELLA = 'umbrella';
    const _NUCLEAR = 'nuclear';
    const _NO_SMOKING = 'no-smoking';
    const _THERMOMETER = 'thermometer';
    const _SPEEDOMETER = 'speedometer';
    const _MODEL_S = 'model-s';
    const _PLANE = 'plane';
    const _JET = 'jet';
    const _LOAD_A = 'load-a';
    const _LOAD_B = 'load-b';
    const _LOAD_C = 'load-c';
    const _LOAD_D = 'load-d';
    const _IOS_IONIC_OUTLINE = 'ios-ionic-outline';
    const _IOS_ARROW_BACK = 'ios-arrow-back';
    const _IOS_ARROW_FORWARD = 'ios-arrow-forward';
    const _IOS_ARROW_UP = 'ios-arrow-up';
    const _IOS_ARROW_RIGHT = 'ios-arrow-right';
    const _IOS_ARROW_DOWN = 'ios-arrow-down';
    const _IOS_ARROW_LEFT = 'ios-arrow-left';
    const _IOS_ARROW_THIN_UP = 'ios-arrow-thin-up';
    const _IOS_ARROW_THIN_RIGHT = 'ios-arrow-thin-right';
    const _IOS_ARROW_THIN_DOWN = 'ios-arrow-thin-down';
    const _IOS_ARROW_THIN_LEFT = 'ios-arrow-thin-left';
    const _IOS_CIRCLE_FILLED = 'ios-circle-filled';
    const _IOS_CIRCLE_OUTLINE = 'ios-circle-outline';
    const _IOS_CHECKMARK_EMPTY = 'ios-checkmark-empty';
    const _IOS_CHECKMARK_OUTLINE = 'ios-checkmark-outline';
    const _IOS_CHECKMARK = 'ios-checkmark';
    const _IOS_PLUS_EMPTY = 'ios-plus-empty';
    const _IOS_PLUS_OUTLINE = 'ios-plus-outline';
    const _IOS_PLUS = 'ios-plus';
    const _IOS_CLOSE_EMPTY = 'ios-close-empty';
    const _IOS_CLOSE_OUTLINE = 'ios-close-outline';
    const _IOS_CLOSE = 'ios-close';
    const _IOS_MINUS_EMPTY = 'ios-minus-empty';
    const _IOS_MINUS_OUTLINE = 'ios-minus-outline';
    const _IOS_MINUS = 'ios-minus';
    const _IOS_INFORMAT_EMPTY = 'ios-information-empty';
    const _IOS_INFORMAT_OUTLINE = 'ios-information-outline';
    const _IOS_INFORMATION = 'ios-information';
    const _IOS_HELP_EMPTY = 'ios-help-empty';
    const _IOS_HELP_OUTLINE = 'ios-help-outline';
    const _IOS_HELP = 'ios-help';
    const _IOS_SEARCH = 'ios-search';
    const _IOS_SEARCH_STRONG = 'ios-search-strong';
    const _IOS_STAR = 'ios-star';
    const _IOS_STAR_HALF = 'ios-star-half';
    const _IOS_STAR_OUTLINE = 'ios-star-outline';
    const _IOS_HEART = 'ios-heart';
    const _IOS_HEART_OUTLINE = 'ios-heart-outline';
    const _IOS_MORE = 'ios-more';
    const _IOS_MORE_OUTLINE = 'ios-more-outline';
    const _IOS_HOME = 'ios-home';
    const _IOS_HOME_OUTLINE = 'ios-home-outline';
    const _IOS_CLOUD = 'ios-cloud';
    const _IOS_CLOUD_OUTLINE = 'ios-cloud-outline';
    const _IOS_CLOUD_UPLOAD = 'ios-cloud-upload';
    const _IOS_CLOUD_UPLOAD_OUTLINE = 'ios-cloud-upload-outline';
    const _IOS_CLOUD_DOWNLOAD = 'ios-cloud-download';
    const _IOS_CLOUD_DOWNLOAD_OUTLINE = 'ios-cloud-download-outline';
    const _IOS_UPLOAD = 'ios-upload';
    const _IOS_UPLOAD_OUTLINE = 'ios-upload-outline';
    const _IOS_DOWNLOAD = 'ios-download';
    const _IOS_DOWNLOAD_OUTLINE = 'ios-download-outline';
    const _IOS_REFRESH = 'ios-refresh';
    const _IOS_REFRESH_OUTLINE = 'ios-refresh-outline';
    const _IOS_REFRESH_EMPTY = 'ios-refresh-empty';
    const _IOS_RELOAD = 'ios-reload';
    const _IOS_LOOP_STRONG = 'ios-loop-strong';
    const _IOS_LOOP = 'ios-loop';
    const _IOS_BOOKMARKS = 'ios-bookmarks';
    const _IOS_BOOKMARKS_OUTLINE = 'ios-bookmarks-outline';
    const _IOS_BOOK = 'ios-book';
    const _IOS_BOOK_OUTLINE = 'ios-book-outline';
    const _IOS_FLAG = 'ios-flag';
    const _IOS_FLAG_OUTLINE = 'ios-flag-outline';
    const _IOS_GLASSES = 'ios-glasses';
    const _IOS_GLASSES_OUTLINE = 'ios-glasses-outline';
    const _IOS_BROWSERS = 'ios-browsers';
    const _IOS_BROWSERS_OUTLINE = 'ios-browsers-outline';
    const _IOS_AT = 'ios-at';
    const _IOS_AT_OUTLINE = 'ios-at-outline';
    const _IOS_PRICETAG = 'ios-pricetag';
    const _IOS_PRICETAG_OUTLINE = 'ios-pricetag-outline';
    const _IOS_PRICETAGS = 'ios-pricetags';
    const _IOS_PRICETAGS_OUTLINE = 'ios-pricetags-outline';
    const _IOS_CART = 'ios-cart';
    const _IOS_CART_OUTLINE = 'ios-cart-outline';
    const _IOS_CHATBOXES = 'ios-chatboxes';
    const _IOS_CHATBOXES_OUTLINE = 'ios-chatboxes-outline';
    const _IOS_CHATBUBBLE = 'ios-chatbubble';
    const _IOS_CHATBUBBLE_OUTLINE = 'ios-chatbubble-outline';
    const _IOS_COG = 'ios-cog';
    const _IOS_COG_OUTLINE = 'ios-cog-outline';
    const _IOS_GEAR = 'ios-gear';
    const _IOS_GEAR_OUTLINE = 'ios-gear-outline';
    const _IOS_SETTINGS = 'ios-settings';
    const _IOS_SETTINGS_STRONG = 'ios-settings-strong';
    const _IOS_TOGGLE = 'ios-toggle';
    const _IOS_TOGGLE_OUTLINE = 'ios-toggle-outline';
    const _IOS_ANALYTICS = 'ios-analytics';
    const _IOS_ANALYTICS_OUTLINE = 'ios-analytics-outline';
    const _IOS_PIE = 'ios-pie';
    const _IOS_PIE_OUTLINE = 'ios-pie-outline';
    const _IOS_PULSE = 'ios-pulse';
    const _IOS_PULSE_STRONG = 'ios-pulse-strong';
    const _IOS_FILING = 'ios-filing';
    const _IOS_FILING_OUTLINE = 'ios-filing-outline';
    const _IOS_BOX = 'ios-box';
    const _IOS_BOX_OUTLINE = 'ios-box-outline';
    const _IOS_COMPOSE = 'ios-compose';
    const _IOS_COMPOSE_OUTLINE = 'ios-compose-outline';
    const _IOS_TRASH = 'ios-trash';
    const _IOS_TRASH_OUTLINE = 'ios-trash-outline';
    const _IOS_COPY = 'ios-copy';
    const _IOS_COPY_OUTLINE = 'ios-copy-outline';
    const _IOS_EMAIL = 'ios-email';
    const _IOS_EMAIL_OUTLINE = 'ios-email-outline';
    const _IOS_UNDO = 'ios-undo';
    const _IOS_UNDO_OUTLINE = 'ios-undo-outline';
    const _IOS_REDO = 'ios-redo';
    const _IOS_REDO_OUTLINE = 'ios-redo-outline';
    const _IOS_PAPERPLANE = 'ios-paperplane';
    const _IOS_PAPERPLANE_OUTLINE = 'ios-paperplane-outline';
    const _IOS_FOLDER = 'ios-folder';
    const _IOS_FOLDER_OUTLINE = 'ios-folder-outline';
    const _IOS_PAPER = 'ios-paper';
    const _IOS_PAPER_OUTLINE = 'ios-paper-outline';
    const _IOS_LIST = 'ios-list';
    const _IOS_LIST_OUTLINE = 'ios-list-outline';
    const _IOS_WORLD = 'ios-world';
    const _IOS_WORLD_OUTLINE = 'ios-world-outline';
    const _IOS_ALARM = 'ios-alarm';
    const _IOS_ALARM_OUTLINE = 'ios-alarm-outline';
    const _IOS_SPEEDOMETER = 'ios-speedometer';
    const _IOS_SPEEDOMETER_OUTLINE = 'ios-speedometer-outline';
    const _IOS_STOPWATCH = 'ios-stopwatch';
    const _IOS_STOPWATCH_OUTLINE = 'ios-stopwatch-outline';
    const _IOS_TIMER = 'ios-timer';
    const _IOS_TIMER_OUTLINE = 'ios-timer-outline';
    const _IOS_CLOCK = 'ios-clock';
    const _IOS_CLOCK_OUTLINE = 'ios-clock-outline';
    const _IOS_TIME = 'ios-time';
    const _IOS_TIME_OUTLINE = 'ios-time-outline';
    const _IOS_CALENDAR = 'ios-calendar';
    const _IOS_CALENDAR_OUTLINE = 'ios-calendar-outline';
    const _IOS_PHOTOS = 'ios-photos';
    const _IOS_PHOTOS_OUTLINE = 'ios-photos-outline';
    const _IOS_ALBUMS = 'ios-albums';
    const _IOS_ALBUMS_OUTLINE = 'ios-albums-outline';
    const _IOS_CAMERA = 'ios-camera';
    const _IOS_CAMERA_OUTLINE = 'ios-camera-outline';
    const _IOS_REVERSE_CAMERA = 'ios-reverse-camera';
    const _IOS_REVERSE_CAMERA_OUTLINE = 'ios-reverse-camera-outline';
    const _IOS_EYE = 'ios-eye';
    const _IOS_EYE_OUTLINE = 'ios-eye-outline';
    const _IOS_BOLT = 'ios-bolt';
    const _IOS_BOLT_OUTLINE = 'ios-bolt-outline';
    const _IOS_COLOR_WAND = 'ios-color-wand';
    const _IOS_COLOR_WAND_OUTLINE = 'ios-color-wand-outline';
    const _IOS_COLOR_FILTER = 'ios-color-filter';
    const _IOS_COLOR_FILTER_OUTLINE = 'ios-color-filter-outline';
    const _IOS_GRID_VIEW = 'ios-grid-view';
    const _IOS_GRID_VIEW_OUTLINE = 'ios-grid-view-outline';
    const _IOS_CROP_STRONG = 'ios-crop-strong';
    const _IOS_CROP = 'ios-crop';
    const _IOS_BARCODE = 'ios-barcode';
    const _IOS_BARCODE_OUTLINE = 'ios-barcode-outline';
    const _IOS_BRIEFCASE = 'ios-briefcase';
    const _IOS_BRIEFCASE_OUTLINE = 'ios-briefcase-outline';
    const _IOS_MEDKIT = 'ios-medkit';
    const _IOS_MEDKIT_OUTLINE = 'ios-medkit-outline';
    const _IOS_MEDICAL = 'ios-medical';
    const _IOS_MEDICAL_OUTLINE = 'ios-medical-outline';
    const _IOS_INFINITE = 'ios-infinite';
    const _IOS_INFINITE_OUTLINE = 'ios-infinite-outline';
    const _IOS_CALCULATOR = 'ios-calculator';
    const _IOS_CALCULATOR_OUTLINE = 'ios-calculator-outline';
    const _IOS_KEYPAD = 'ios-keypad';
    const _IOS_KEYPAD_OUTLINE = 'ios-keypad-outline';
    const _IOS_TELEPHONE = 'ios-telephone';
    const _IOS_TELEPHONE_OUTLINE = 'ios-telephone-outline';
    const _IOS_DRAG = 'ios-drag';
    const _IOS_LOCATION = 'ios-location';
    const _IOS_LOCAT_OUTLINE = 'ios-location-outline';
    const _IOS_NAVIGATE = 'ios-navigate';
    const _IOS_NAVIGATE_OUTLINE = 'ios-navigate-outline';
    const _IOS_LOCKED = 'ios-locked';
    const _IOS_LOCKED_OUTLINE = 'ios-locked-outline';
    const _IOS_UNLOCKED = 'ios-unlocked';
    const _IOS_UNLOCKED_OUTLINE = 'ios-unlocked-outline';
    const _IOS_MONITOR = 'ios-monitor';
    const _IOS_MONITOR_OUTLINE = 'ios-monitor-outline';
    const _IOS_PRINTER = 'ios-printer';
    const _IOS_PRINTER_OUTLINE = 'ios-printer-outline';
    const _IOS_GAME_CONTROLLER_A = 'ios-game-controller-a';
    const _IOS_GAME_CONTROLLER_A_OUTLINE = 'ios-game-controller-a-outline';
    const _IOS_GAME_CONTROLLER_B = 'ios-game-controller-b';
    const _IOS_GAME_CONTROLLER_B_OUTLINE = 'ios-game-controller-b-outline';
    const _IOS_AMERICANFOOTBALL = 'ios-americanfootball';
    const _IOS_AMERICANFOOTBALL_OUTLINE = 'ios-americanfootball-outline';
    const _IOS_BASEBALL = 'ios-baseball';
    const _IOS_BASEBALL_OUTLINE = 'ios-baseball-outline';
    const _IOS_BASKETBALL = 'ios-basketball';
    const _IOS_BASKETBALL_OUTLINE = 'ios-basketball-outline';
    const _IOS_TENNISBALL = 'ios-tennisball';
    const _IOS_TENNISBALL_OUTLINE = 'ios-tennisball-outline';
    const _IOS_FOOTBALL = 'ios-football';
    const _IOS_FOOTBALL_OUTLINE = 'ios-football-outline';
    const _IOS_BODY = 'ios-body';
    const _IOS_BODY_OUTLINE = 'ios-body-outline';
    const _IOS_PERSON = 'ios-person';
    const _IOS_PERSON_OUTLINE = 'ios-person-outline';
    const _IOS_PERSONADD = 'ios-personadd';
    const _IOS_PERSONADD_OUTLINE = 'ios-personadd-outline';
    const _IOS_PEOPLE = 'ios-people';
    const _IOS_PEOPLE_OUTLINE = 'ios-people-outline';
    const _IOS_MUSICAL_NOTES = 'ios-musical-notes';
    const _IOS_MUSICAL_NOTE = 'ios-musical-note';
    const _IOS_BELL = 'ios-bell';
    const _IOS_BELL_OUTLINE = 'ios-bell-outline';
    const _IOS_MIC = 'ios-mic';
    const _IOS_MIC_OUTLINE = 'ios-mic-outline';
    const _IOS_MIC_OFF = 'ios-mic-off';
    const _IOS_VOLUME_HIGH = 'ios-volume-high';
    const _IOS_VOLUME_LOW = 'ios-volume-low';
    const _IOS_PLAY = 'ios-play';
    const _IOS_PLAY_OUTLINE = 'ios-play-outline';
    const _IOS_PAUSE = 'ios-pause';
    const _IOS_PAUSE_OUTLINE = 'ios-pause-outline';
    const _IOS_RECORDING = 'ios-recording';
    const _IOS_RECORDING_OUTLINE = 'ios-recording-outline';
    const _IOS_FASTFORWARD = 'ios-fastforward';
    const _IOS_FASTFORWARD_OUTLINE = 'ios-fastforward-outline';
    const _IOS_REWIND = 'ios-rewind';
    const _IOS_REWIND_OUTLINE = 'ios-rewind-outline';
    const _IOS_SKIPBACKWARD = 'ios-skipbackward';
    const _IOS_SKIPBACKWARD_OUTLINE = 'ios-skipbackward-outline';
    const _IOS_SKIPFORWARD = 'ios-skipforward';
    const _IOS_SKIPFORWARD_OUTLINE = 'ios-skipforward-outline';
    const _IOS_SHUFFLE_STRONG = 'ios-shuffle-strong';
    const _IOS_SHUFFLE = 'ios-shuffle';
    const _IOS_VIDEOCAM = 'ios-videocam';
    const _IOS_VIDEOCAM_OUTLINE = 'ios-videocam-outline';
    const _IOS_FILM = 'ios-film';
    const _IOS_FILM_OUTLINE = 'ios-film-outline';
    const _IOS_FLASK = 'ios-flask';
    const _IOS_FLASK_OUTLINE = 'ios-flask-outline';
    const _IOS_LIGHTBULB = 'ios-lightbulb';
    const _IOS_LIGHTBULB_OUTLINE = 'ios-lightbulb-outline';
    const _IOS_WINEGLASS = 'ios-wineglass';
    const _IOS_WINEGLASS_OUTLINE = 'ios-wineglass-outline';
    const _IOS_PINT = 'ios-pint';
    const _IOS_PINT_OUTLINE = 'ios-pint-outline';
    const _IOS_NUTRITION = 'ios-nutrition';
    const _IOS_NUTRIT_OUTLINE = 'ios-nutrition-outline';
    const _IOS_FLOWER = 'ios-flower';
    const _IOS_FLOWER_OUTLINE = 'ios-flower-outline';
    const _IOS_ROSE = 'ios-rose';
    const _IOS_ROSE_OUTLINE = 'ios-rose-outline';
    const _IOS_PAW = 'ios-paw';
    const _IOS_PAW_OUTLINE = 'ios-paw-outline';
    const _IOS_FLAME = 'ios-flame';
    const _IOS_FLAME_OUTLINE = 'ios-flame-outline';
    const _IOS_SUNNY = 'ios-sunny';
    const _IOS_SUNNY_OUTLINE = 'ios-sunny-outline';
    const _IOS_PARTLYSUNNY = 'ios-partlysunny';
    const _IOS_PARTLYSUNNY_OUTLINE = 'ios-partlysunny-outline';
    const _IOS_CLOUDY = 'ios-cloudy';
    const _IOS_CLOUDY_OUTLINE = 'ios-cloudy-outline';
    const _IOS_RAINY = 'ios-rainy';
    const _IOS_RAINY_OUTLINE = 'ios-rainy-outline';
    const _IOS_THUNDERSTORM = 'ios-thunderstorm';
    const _IOS_THUNDERSTORM_OUTLINE = 'ios-thunderstorm-outline';
    const _IOS_SNOWY = 'ios-snowy';
    const _IOS_MOON = 'ios-moon';
    const _IOS_MOON_OUTLINE = 'ios-moon-outline';
    const _IOS_CLOUDY_NIGHT = 'ios-cloudy-night';
    const _IOS_CLOUDY_NIGHT_OUTLINE = 'ios-cloudy-night-outline';
    const _ANDROID_ARROW_UP = 'android-arrow-up';
    const _ANDROID_ARROW_FORWARD = 'android-arrow-forward';
    const _ANDROID_ARROW_DOWN = 'android-arrow-down';
    const _ANDROID_ARROW_BACK = 'android-arrow-back';
    const _ANDROID_ARROW_DROPUP = 'android-arrow-dropup';
    const _ANDROID_ARROW_DROPUP_CIRCLE = 'android-arrow-dropup-circle';
    const _ANDROID_ARROW_DROPRIGHT = 'android-arrow-dropright';
    const _ANDROID_ARROW_DROPRIGHT_CIRCLE = 'android-arrow-dropright-circle';
    const _ANDROID_ARROW_DROPDOWN = 'android-arrow-dropdown';
    const _ANDROID_ARROW_DROPDOWN_CIRCLE = 'android-arrow-dropdown-circle';
    const _ANDROID_ARROW_DROPLEFT = 'android-arrow-dropleft';
    const _ANDROID_ARROW_DROPLEFT_CIRCLE = 'android-arrow-dropleft-circle';
    const _ANDROID_ADD = 'android-add';
    const _ANDROID_ADD_CIRCLE = 'android-add-circle';
    const _ANDROID_REMOVE = 'android-remove';
    const _ANDROID_REMOVE_CIRCLE = 'android-remove-circle';
    const _ANDROID_CLOSE = 'android-close';
    const _ANDROID_CANCEL = 'android-cancel';
    const _ANDROID_RADIO_BUTTON_OFF = 'android-radio-button-off';
    const _ANDROID_RADIO_BUTTON_ON = 'android-radio-button-on';
    const _ANDROID_CHECKMARK_CIRCLE = 'android-checkmark-circle';
    const _ANDROID_CHECKBOX_OUTLINE_BLANK = 'android-checkbox-outline-blank';
    const _ANDROID_CHECKBOX_OUTLINE = 'android-checkbox-outline';
    const _ANDROID_CHECKBOX_BLANK = 'android-checkbox-blank';
    const _ANDROID_CHECKBOX = 'android-checkbox';
    const _ANDROID_DONE = 'android-done';
    const _ANDROID_DONE_ALL = 'android-done-all';
    const _ANDROID_MENU = 'android-menu';
    const _ANDROID_MORE_HORIZONTAL = 'android-more-horizontal';
    const _ANDROID_MORE_VERTICAL = 'android-more-vertical';
    const _ANDROID_REFRESH = 'android-refresh';
    const _ANDROID_SYNC = 'android-sync';
    const _ANDROID_WIFI = 'android-wifi';
    const _ANDROID_CALL = 'android-call';
    const _ANDROID_APPS = 'android-apps';
    const _ANDROID_SETTINGS = 'android-settings';
    const _ANDROID_OPTIONS = 'android-options';
    const _ANDROID_FUNNEL = 'android-funnel';
    const _ANDROID_SEARCH = 'android-search';
    const _ANDROID_HOME = 'android-home';
    const _ANDROID_CLOUD_OUTLINE = 'android-cloud-outline';
    const _ANDROID_CLOUD = 'android-cloud';
    const _ANDROID_DOWNLOAD = 'android-download';
    const _ANDROID_UPLOAD = 'android-upload';
    const _ANDROID_CLOUD_DONE = 'android-cloud-done';
    const _ANDROID_CLOUD_CIRCLE = 'android-cloud-circle';
    const _ANDROID_FAVORITE_OUTLINE = 'android-favorite-outline';
    const _ANDROID_FAVORITE = 'android-favorite';
    const _ANDROID_STAR_OUTLINE = 'android-star-outline';
    const _ANDROID_STAR_HALF = 'android-star-half';
    const _ANDROID_STAR = 'android-star';
    const _ANDROID_CALENDAR = 'android-calendar';
    const _ANDROID_ALARM_CLOCK = 'android-alarm-clock';
    const _ANDROID_TIME = 'android-time';
    const _ANDROID_STOPWATCH = 'android-stopwatch';
    const _ANDROID_WATCH = 'android-watch';
    const _ANDROID_LOCATE = 'android-locate';
    const _ANDROID_NAVIGATE = 'android-navigate';
    const _ANDROID_PIN = 'android-pin';
    const _ANDROID_COMPASS = 'android-compass';
    const _ANDROID_MAP = 'android-map';
    const _ANDROID_WALK = 'android-walk';
    const _ANDROID_BICYCLE = 'android-bicycle';
    const _ANDROID_CAR = 'android-car';
    const _ANDROID_BUS = 'android-bus';
    const _ANDROID_SUBWAY = 'android-subway';
    const _ANDROID_TRAIN = 'android-train';
    const _ANDROID_BOAT = 'android-boat';
    const _ANDROID_PLANE = 'android-plane';
    const _ANDROID_RESTAURANT = 'android-restaurant';
    const _ANDROID_BAR = 'android-bar';
    const _ANDROID_CART = 'android-cart';
    const _ANDROID_CAMERA = 'android-camera';
    const _ANDROID_IMAGE = 'android-image';
    const _ANDROID_FILM = 'android-film';
    const _ANDROID_COLOR_PALETTE = 'android-color-palette';
    const _ANDROID_CREATE = 'android-create';
    const _ANDROID_MAIL = 'android-mail';
    const _ANDROID_DRAFTS = 'android-drafts';
    const _ANDROID_SEND = 'android-send';
    const _ANDROID_ARCHIVE = 'android-archive';
    const _ANDROID_DELETE = 'android-delete';
    const _ANDROID_ATTACH = 'android-attach';
    const _ANDROID_SHARE = 'android-share';
    const _ANDROID_SHARE_ALT = 'android-share-alt';
    const _ANDROID_BOOKMARK = 'android-bookmark';
    const _ANDROID_DOCUMENT = 'android-document';
    const _ANDROID_CLIPBOARD = 'android-clipboard';
    const _ANDROID_LIST = 'android-list';
    const _ANDROID_FOLDER_OPEN = 'android-folder-open';
    const _ANDROID_FOLDER = 'android-folder';
    const _ANDROID_PRINT = 'android-print';
    const _ANDROID_OPEN = 'android-open';
    const _ANDROID_EXIT = 'android-exit';
    const _ANDROID_CONTRACT = 'android-contract';
    const _ANDROID_EXPAND = 'android-expand';
    const _ANDROID_GLOBE = 'android-globe';
    const _ANDROID_CHAT = 'android-chat';
    const _ANDROID_TEXTSMS = 'android-textsms';
    const _ANDROID_HANGOUT = 'android-hangout';
    const _ANDROID_HAPPY = 'android-happy';
    const _ANDROID_SAD = 'android-sad';
    const _ANDROID_PERSON = 'android-person';
    const _ANDROID_PEOPLE = 'android-people';
    const _ANDROID_PERSON_ADD = 'android-person-add';
    const _ANDROID_CONTACT = 'android-contact';
    const _ANDROID_CONTACTS = 'android-contacts';
    const _ANDROID_PLAYSTORE = 'android-playstore';
    const _ANDROID_LOCK = 'android-lock';
    const _ANDROID_UNLOCK = 'android-unlock';
    const _ANDROID_MICROPHONE = 'android-microphone';
    const _ANDROID_MICROPHONE_OFF = 'android-microphone-off';
    const _ANDROID_NOTIFICATIONS_NONE = 'android-notifications-none';
    const _ANDROID_NOTIFICATIONS = 'android-notifications';
    const _ANDROID_NOTIFICATIONS_OFF = 'android-notifications-off';
    const _ANDROID_VOLUME_MUTE = 'android-volume-mute';
    const _ANDROID_VOLUME_DOWN = 'android-volume-down';
    const _ANDROID_VOLUME_UP = 'android-volume-up';
    const _ANDROID_VOLUME_OFF = 'android-volume-off';
    const _ANDROID_HAND = 'android-hand';
    const _ANDROID_DESKTOP = 'android-desktop';
    const _ANDROID_LAPTOP = 'android-laptop';
    const _ANDROID_PHONE_PORTRAIT = 'android-phone-portrait';
    const _ANDROID_PHONE_LANDSCAPE = 'android-phone-landscape';
    const _ANDROID_BULB = 'android-bulb';
    const _ANDROID_SUNNY = 'android-sunny';
    const _ANDROID_ALERT = 'android-alert';
    const _ANDROID_WARNING = 'android-warning';
    const _SOCIAL_TWITTER = 'social-twitter';
    const _SOCIAL_TWITTER_OUTLINE = 'social-twitter-outline';
    const _SOCIAL_FACEBOOK = 'social-facebook';
    const _SOCIAL_FACEBOOK_OUTLINE = 'social-facebook-outline';
    const _SOCIAL_GOOGLEPLUS = 'social-googleplus';
    const _SOCIAL_GOOGLEPLUS_OUTLINE = 'social-googleplus-outline';
    const _SOCIAL_GOOGLE = 'social-google';
    const _SOCIAL_GOOGLE_OUTLINE = 'social-google-outline';
    const _SOCIAL_DRIBBBLE = 'social-dribbble';
    const _SOCIAL_DRIBBBLE_OUTLINE = 'social-dribbble-outline';
    const _SOCIAL_OCTOCAT = 'social-octocat';
    const _SOCIAL_GITHUB = 'social-github';
    const _SOCIAL_GITHUB_OUTLINE = 'social-github-outline';
    const _SOCIAL_INSTAGRAM = 'social-instagram';
    const _SOCIAL_INSTAGRAM_OUTLINE = 'social-instagram-outline';
    const _SOCIAL_WHATSAPP = 'social-whatsapp';
    const _SOCIAL_WHATSAPP_OUTLINE = 'social-whatsapp-outline';
    const _SOCIAL_SNAPCHAT = 'social-snapchat';
    const _SOCIAL_SNAPCHAT_OUTLINE = 'social-snapchat-outline';
    const _SOCIAL_FOURSQUARE = 'social-foursquare';
    const _SOCIAL_FOURSQUARE_OUTLINE = 'social-foursquare-outline';
    const _SOCIAL_PINTEREST = 'social-pinterest';
    const _SOCIAL_PINTEREST_OUTLINE = 'social-pinterest-outline';
    const _SOCIAL_RSS = 'social-rss';
    const _SOCIAL_RSS_OUTLINE = 'social-rss-outline';
    const _SOCIAL_TUMBLR = 'social-tumblr';
    const _SOCIAL_TUMBLR_OUTLINE = 'social-tumblr-outline';
    const _SOCIAL_WORDPRESS = 'social-wordpress';
    const _SOCIAL_WORDPRESS_OUTLINE = 'social-wordpress-outline';
    const _SOCIAL_REDDIT = 'social-reddit';
    const _SOCIAL_REDDIT_OUTLINE = 'social-reddit-outline';
    const _SOCIAL_HACKERNEWS = 'social-hackernews';
    const _SOCIAL_HACKERNEWS_OUTLINE = 'social-hackernews-outline';
    const _SOCIAL_DESIGNERNEWS = 'social-designernews';
    const _SOCIAL_DESIGNERNEWS_OUTLINE = 'social-designernews-outline';
    const _SOCIAL_YAHOO = 'social-yahoo';
    const _SOCIAL_YAHOO_OUTLINE = 'social-yahoo-outline';
    const _SOCIAL_BUFFER = 'social-buffer';
    const _SOCIAL_BUFFER_OUTLINE = 'social-buffer-outline';
    const _SOCIAL_SKYPE = 'social-skype';
    const _SOCIAL_SKYPE_OUTLINE = 'social-skype-outline';
    const _SOCIAL_LINKEDIN = 'social-linkedin';
    const _SOCIAL_LINKEDIN_OUTLINE = 'social-linkedin-outline';
    const _SOCIAL_VIMEO = 'social-vimeo';
    const _SOCIAL_VIMEO_OUTLINE = 'social-vimeo-outline';
    const _SOCIAL_TWITCH = 'social-twitch';
    const _SOCIAL_TWITCH_OUTLINE = 'social-twitch-outline';
    const _SOCIAL_YOUTUBE = 'social-youtube';
    const _SOCIAL_YOUTUBE_OUTLINE = 'social-youtube-outline';
    const _SOCIAL_DROPBOX = 'social-dropbox';
    const _SOCIAL_DROPBOX_OUTLINE = 'social-dropbox-outline';
    const _SOCIAL_APPLE = 'social-apple';
    const _SOCIAL_APPLE_OUTLINE = 'social-apple-outline';
    const _SOCIAL_ANDROID = 'social-android';
    const _SOCIAL_ANDROID_OUTLINE = 'social-android-outline';
    const _SOCIAL_WINDOWS = 'social-windows';
    const _SOCIAL_WINDOWS_OUTLINE = 'social-windows-outline';
    const _SOCIAL_HTML5 = 'social-html5';
    const _SOCIAL_HTML5_OUTLINE = 'social-html5-outline';
    const _SOCIAL_CSS3 = 'social-css3';
    const _SOCIAL_CSS3_OUTLINE = 'social-css3-outline';
    const _SOCIAL_JAVASCRIPT = 'social-javascript';
    const _SOCIAL_JAVASCRIPT_OUTLINE = 'social-javascript-outline';
    const _SOCIAL_ANGULAR = 'social-angular';
    const _SOCIAL_ANGULAR_OUTLINE = 'social-angular-outline';
    const _SOCIAL_NODEJS = 'social-nodejs';
    const _SOCIAL_SASS = 'social-sass';
    const _SOCIAL_PYTHON = 'social-python';
    const _SOCIAL_CHROME = 'social-chrome';
    const _SOCIAL_CHROME_OUTLINE = 'social-chrome-outline';
    const _SOCIAL_CODEPEN = 'social-codepen';
    const _SOCIAL_CODEPEN_OUTLINE = 'social-codepen-outline';
    const _SOCIAL_MARKDOWN = 'social-markdown';
    const _SOCIAL_TUX = 'social-tux';
    const _SOCIAL_FREEBSD_DEVIL = 'social-freebsd-devil';
    const _SOCIAL_USD = 'social-usd';
    const _SOCIAL_USD_OUTLINE = 'social-usd-outline';
    const _SOCIAL_BITCOIN = 'social-bitcoin';
    const _SOCIAL_BITCOIN_OUTLINE = 'social-bitcoin-outline';
    const _SOCIAL_YEN = 'social-yen';
    const _SOCIAL_YEN_OUTLINE = 'social-yen-outline';
    const _SOCIAL_EURO = 'social-euro';
    const _SOCIAL_EURO_OUTLINE = 'social-euro-outline';
}