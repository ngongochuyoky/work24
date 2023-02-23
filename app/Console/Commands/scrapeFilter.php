<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Cities;
use App\Category;

class scrapeFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    $location = ["Hà Nội" ,"Hồ Chí Minh", "An Giang","an giang an giang","Bạc Liêu","Bà Rịa - Vũng Tàu","Bắc Cạn","Bắc Giang","Bắc Ninh","Bến Tre","Bình Dương","Bình Định","Bình Phước","Bình Thuận", "Cao Bằng","Cà Mau","Cần Thơ","Đà Nẵng","Đắc Lắc", "Đắc Nông","Điện Biên","Đồng Nai","Đồng Tháp","Gia Lai","Hà Giang","Hà Nam","Hà Tây","Hà Tĩnh","Hải Dương","Hải Phòng","Hậu Giang","Hòa Bình","Hưng Yên","Khánh Hòa","Kiên Giang", "Kon Tum","Lai Châu","Lạng Sơn","Lào Cai","Lâm Đồng","Long An","Nam Định","Nghệ An","Ninh Bình","Ninh Thuận","Phú Thọ","Phú Yên","Quảng Bình","Quảng Nam","Quảng Ngãi","Quảng Ninh","Quảng Trị","Sóc Trăng","Sơn La","Tây Ninh","Thái Bình","Thái Nguyên","Thanh Hóa","Thừa Thiên Huê","Tiền Giang","Trà Vinh","Tuyên Quang","Vĩnh Long","Vĩnh Phúc","Yên Bái"];

    

    

    $category = ["Bán hàng","Biên tập\Báo chí\Truyền hình","Bảo hiểm\Tư vấn bảo hiểm","Bảo vệ\An ninh\Vệ sỹ","Phiên dịch\Ngoại ngữ","Bưu chính","Chứng khoán - Vàng","Cơ khí - Chế tạo","Công chức - Viên chức", "Công nghệ cao","Công nghiệp","Dầu khí - Hóa chất","Dệt may - Da giày","Dịch vụ", "Du lịch","Đầu tư","Điện - Điện tử - Điện lạnh","Điện tử viễn thông","Freelance","Games","Giáo dục - Đào tạo","Giao nhận\Vận chuyển\Kho bãi","Hàng gia dụng","Hàng hải","Hàng không","Hành chính - Văn phòng","Hóa học - Sinh học","Hoạch định - Dự án","IT phần cứng\mạng","IT phần mềm","In ấn - Xuất bản","Kế toán - Kiểm toán","Khách sạn - Nhà hàng","Kiến trúc - Thiết kế nội thất","Bất động sản","Kỹ thuật","Kỹ thuật ứng dụng","Làm bán thời gian","Làm đẹp\Thể lực\Spa","Lao động phổ thông","Lương cao","Marketing - PR","Môi trường","Mỹ phẩm - Trang sức","Ngân hàng\Tài Chính","Ngành nghề khác","Nghệ thuật - Điện ảnh","Người giúp việc\Phục vụ\Tạp vụ","Nhân sự","Nhân viên kinh doanh","Nông - Lâm - Ngư nghiệp","Ô tô - Xe máy","Pháp luật\Pháp lý","Phát triển thị trường","Promotion Girl\Boy (PG-PB)","QA-QC\Thẩm định\Giám định","Quan hệ đối ngoại","Quản trị kinh doanh","Sinh viên làm thêm","Startup","Thể dục\Thể thao","Thiết kế - Mỹ thuật","Thiết kế đồ họa - Web","Thời trang","Thủ công mỹ nghệ","Thư ký - Trợ lý","Thực phẩm - Đồ uống","Thực tập","Thương mại điện tử","Tiếp thị - Quảng cáo","Tổ chức sự kiện - Quà tặng","Tư vấn\Chăm sóc khách hàng","Vận tải - Lái xe\Tài xế","Nhân viên trông quán internet","Vật tư\Thiết bị\Mua hàng","Việc làm cấp cao","Việc làm Tết","Xây dựng","Xuất - Nhập khẩu","Xuất khẩu lao động","Y tế - Dược"];


    for($i = 0; $i < count($category); $i++) {
         // $data = new Cities();
         $data = new Category();
         $data->name = $category[$i];
          $data->save();
         print('Insert thành công');
    }





    }
   
}
