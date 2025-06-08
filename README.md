
## Cấu trúc thư mục dự án MVC PHP

```
My_e_wallet/
└── www/
    ├── index.php                
    ├── .htaccess             
    ├── .dockerignore                
    ├── compose-dev.yaml               
    ├── Dockerfile               
    ├── main.js              
    ├── style.css                
    ├── admin/
    │   └── db.php
    ├── controllers/
    │   ├── AdminController.php
    │   ├── BaseController.php
    │   ├── HomeController.php
    │   ├── LoginController.php
    │   └── RegisterController.php
    ├── core/
    │   ├── database.php        
    │   └── vendor/
    │       ├── autoload.php
    │       ├── composer/...
    │       └── phpmailer/...       
    ├── images/...
    ├── Models
    │   ├── AdminModel.php
    │   ├── BaseModel.php
    │   ├── CreditModel.php
    │   ├── HomeModel.php
    │   ├── LoginModel.php
    │   ├── PhonecardModel.php
    │   └── RegisterModel.php
    ├── public
    │   └── upload/...
    └── Views/
        ├── head.php
        ├── linkJS.php
        ├── home/...
        ├── login/...
        ├── register/...
        └── admin/...
```

## Lợi ích sử dụng MVC với PHP thuần

* Dễ tổ chức và phân chia công việc (nhất là khi làm team)
* Tách riêng giữa **xử lý**, **giao diện** và **dữ liệu**
* Dễ bảo trì, dễ mở rộng thành framework mini
* Thích hợp cho các bạn muốn **tự học PHP nâng cao** hoặc chuẩn bị học Laravel
