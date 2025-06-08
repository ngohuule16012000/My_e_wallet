
## Cấu trúc thư mục dự án MVC PHP

```
www/
└── mymvc/
    ├── index.php                  ← File chính để route
    ├── .htaccess                  ← (Tùy chọn) Viết lại URL
    ├── app/
    │   ├── controllers/
    │   │   └── HomeController.php
    │   ├── models/
    │   │   └── Product.php
    │   └── views/
    │       ├── home.php
    │       └── layout.php
    ├── core/
    │   ├── App.php                ← Xử lý routing
    │   └── Controller.php         ← Class cha cho tất cả Controller
    ├── public/
    │   ├── css/
    │   └── js/
    └── config/
        └── config.php             ← Kết nối database
```

---

### ⚙️ 3. Quy trình hoạt động MVC

1. Truy cập URL `http://localhost/mymvc/index.php?url=home/index`
2. `index.php` gọi `App.php` để phân tích URL và gọi `HomeController.php`
3. `HomeController.php` xử lý logic, gọi `Model` nếu cần, rồi trả `View`
4. `home.php` hiển thị nội dung giao diện

---

### 🧩 4. Ví dụ đơn giản

#### 📄 `index.php`

```php
require_once 'core/App.php';
require_once 'core/Controller.php';

$app = new App();
```

#### 📄 `core/App.php` (tối giản)

```php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        if(file_exists('app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
```

---

### ✅ 5. Lợi ích sử dụng MVC với PHP thuần

* Dễ tổ chức và phân chia công việc (nhất là khi làm team)
* Tách riêng giữa **xử lý**, **giao diện** và **dữ liệu**
* Dễ bảo trì, dễ mở rộng thành framework mini
* Thích hợp cho các bạn muốn **tự học PHP nâng cao** hoặc chuẩn bị học Laravel
