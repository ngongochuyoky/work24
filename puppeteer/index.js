const puppeteer = require('puppeteer');
var moment = require('moment');

let id_categorys = '';
let id_cities = '';


(async () => {
    try {
        const browser = await puppeteer.launch({
            headless: false
        });
        const page = await browser.newPage();
        page.setViewport({
            width: 1280,
            height: 720
        });
        await page.goto('https://mywork.com.vn/tuyen-dung');
        await page.evaluate(scrollToBottom);


        const arr_link = await page.evaluate(() => {
            let result = document.querySelectorAll("p.j_title a.el-tooltip.item");
            let ar_result = [];
            result.forEach(item => {
                ar_result.push({
                    href: item.getAttribute('href').trim(),
                })
            });
            return ar_result;
        });

        console.log(arr_link.length);

        // chứa danh sách những promise
        const promises = [];
        for (let i = 0; i < arr_link.length; i++) {
            promises.push(await getLink(arr_link[i].href, page, i))
        }
        await browser.close();
    } catch (error) {
        console.log("Catch : " + error);
    }
})();
async function getLink(link, page, key) {

    var URL = 'https://mywork.com.vn';
    await page.goto(URL + link, {
        // Set timeout cho page
        timeout: 3000000
    });

    // Chờ 2s sau khi page được load để tránh overload
    await page.waitFor(2000);

    console.log(URL + link);

    // lấy dữ liệu và insert bảng jobs
    let name = await page.evaluate(() => {
        let name = document.querySelector("h1.main-title");
        return name.innerText;
    });

    let elementSpan = await page.evaluate(() => {
        let elementSpan = document.querySelectorAll(".job_detail_general .item p");
        let arr_elementSpan = [];
        elementSpan.forEach(function(element) {
            arr_elementSpan.push(element.innerText);
        });
        return arr_elementSpan;
    });

    // bảng kinh nghiệm
    let experience = elementSpan[0];
    experience = experience.slice(13);

    // bảng bằng cấp
    let degree = elementSpan[1];
    degree = degree.slice(18);

    let number_people = elementSpan[2];
    number_people = number_people.slice(20);

    // bảng hình thức làm việc
    let form_of_work = elementSpan[3];
    form_of_work = form_of_work.slice(20);

    // bảng chuc_vu
    let chuc_vu = elementSpan[4];
    chuc_vu = chuc_vu.slice(9);

    let gender = elementSpan[5];
    gender = gender.slice(19);


    // bảng category
    let category = await page.evaluate(() => {
        let box_category = document.querySelectorAll(".job-cat span");
        let arr_category = [];
        box_category.forEach(function(item) {
            arr_category.push(item.innerText);
        });
        return arr_category;
    });




    // bảng địa điểm
    let cities = await page.evaluate(() => {
        let box_cities = document.querySelectorAll("span.location_tag a");
        let arr_cities = [];
        box_cities.forEach(function(item) {
            arr_cities.push(item.innerText);
        });

        return arr_cities;
    });


    // bảng lương
    let salary = await page.evaluate(() => {
        let salary = document.querySelector(".row-standard span.text_red");
        return salary.innerText;
    });

    let box_mo_ta = await page.evaluate(() => {
        let element_box = document.querySelectorAll(".mw-box-item");
        let arr_mota = [];
        element_box.forEach(function(item) {
            arr_mota.push(item.innerText);
        });
        return arr_mota;
    });

    let description = box_mo_ta[2];
    if (description.search('"')) {
        description = description.replace(/"/g, '');
    }
    if (description.search("'")) {
        description = description.replace(/'/g, '');
    }

    let Welfare = box_mo_ta[3];
    if (Welfare.search('"')) {
        Welfare = Welfare.replace(/"/g, '');
    }
    if (Welfare.search("'")) {
        Welfare = Welfare.replace(/'/g, '');
    }
    let requirements_other = box_mo_ta[4];
    if (requirements_other.search('"')) {
        requirements_other = requirements_other.replace(/"/g, '');
    }
    if (requirements_other.search("'")) {
        requirements_other = requirements_other.replace(/'/g, '');
    }

    let box_contact = await page.evaluate(() => {
        let element_box = document.querySelectorAll(".box-contact .item");
        let arr_contact = [];
        element_box.forEach(function(item) {
            arr_contact.push(item.innerText);
        });
        return arr_contact;
    });
    var name_employer;
    var address;
    var email_employer;
    var tel_employer;
    var date_expired;
    var language;
    if (box_contact.length === 5) {
        name_employer = box_contact[0];
        address = box_contact[1];
        date_expired = box_contact[2].trim().split("/").reverse().toString().replace(/,/g, '-')
        language = box_contact[3];
    }
    if (box_contact.length === 7) {
        name_employer = box_contact[0];
        email_employer = box_contact[1];
        tel_employer = box_contact[2];
        address = box_contact[3];
        date_expired = box_contact[4].trim().split("/").reverse().toString().replace(/,/g, '-')
        language = box_contact[5];
    }


    // lấy thông tin employers

    let name_cong_ty = await page.evaluate(() => {
        let test = document.querySelector("p.company-name a.capitalize.fs-16.mt-10");
        return test.innerText;
    });
    name_cong_ty = name_cong_ty.replace(/'/g, '');

    let logo = await page.evaluate(() => {
        let logo = document.querySelector(".j_logo img.lazy-load");
        return logo.src;
    });

    let quy_mo = await page.evaluate(() => {
        let result = document.querySelector("p.config");
        return result.innerText;
    });
    quy_mo = quy_mo.slice(14);

    let link_cong_ty = await page.evaluate(() => {
        let test = document.querySelector("p.company-name a.capitalize.fs-16.mt-10");
        return test.href;
    });

    // vào page cong ty lấy thông tin

    await page.goto(link_cong_ty, {
        // Set timeout cho page
        timeout: 3000000
    });
    // Chờ 2s sau khi page được load để tránh overload
    await page.waitFor(2000);

    let introduce = await page.evaluate(() => {
        let result = document.querySelector(".desc read-more");
        if (result === null) {
            let result = document.querySelector(".desc p.text-muted");
            if (result === null) {
                return '';
            }
            return result.innerText;
        }
        return result.getAttribute('text');
    });

    if (introduce.search('"')) {
        introduce = introduce.replace(/"/g, '');
    }
    if (introduce.search(" ' ")) {
        introduce = introduce.replace(/'/g, '');
    }


    let website = await page.evaluate(() => {
        let result = document.querySelectorAll(".j_company p");
        if (result.length < 0) {
            return '';
        }
        let arr_ws = [];
        result.forEach(function(item) {
            arr_ws.push(item.innerText);
        });
        return arr_ws;
    });
    if (website.length > 0) {
        website = website[2].slice(9);
    } else {
        return '';
    }

    // lấy ngày giờ update tự động
    var date = moment().format('L');
    var date_arr = date.split('/');
    date_arr = date_arr.reverse();
    var str_date = date_arr[0].concat('-', date_arr[2], '-', date_arr[1]);
    var hour = moment().format('LTS');
    hour = hour.replace(/PM/g, '').trim()

    var date_hour = str_date.concat(' ', hour);


    // lấy random info_employer 
    function randomString(len, charSet) {
        charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var randomString = '';
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz, randomPoz + 1);
        }
        return randomString;
    }
    var email = randomString(6) + '@gmail.com';
    var password = randomString(8);


    //======================== kết mối mysql ===============================
    var mysql = require('mysql');

    console.log('Get connection ...');

    var connString = 'mysql://root:@localhost/work24?charset=utf8_general_ci&timezone=-0700';
    var conn = mysql.createConnection(connString);

    conn.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
    });




    function getInserCities(name_table, arr) {

        arr.forEach(function(item, index) {

            var selectTable = "SELECT id, name_cities FROM " + name_table + " WHERE name_cities = '" + item + "'";
            conn.query(selectTable, function(err, result) {
                if (err) throw err;

                if (result.length > 0) {

                    id_cities = id_cities.concat(result[0].id + ',');

                } else {
                    var insertTable = "INSERT INTO " + name_table + " (name_cities, created_at, updated_at) VALUES ('" + item + "', '" + date_hour + "', '" + date_hour + "')";
                    conn.query(insertTable, function(err, result) {
                        if (err) throw err;

                        id_cities = id_cities.concat(result.insertId + ',');

                    });
                }
            });

        })

        getInsertCategory('category', category);
        id_cities = '';

    }

    function getInsertCategory(name_table, arr) {
        arr.forEach(function(item, index) {
            var selectTable = "SELECT id, name_category FROM " + name_table + " WHERE name_category = '" + item + "'";
            conn.query(selectTable, function(err, result) {
                if (err) throw err;
                if (result.length > 0) {
                    id_categorys = id_categorys.concat(result[0].id + ',');
                } else {
                    var insertTable = "INSERT INTO " + name_table + " (name_category, created_at, updated_at) VALUES ('" + item + "', '" + date_hour + "', '" + date_hour + "')";
                    conn.query(insertTable, function(err, result) {
                        if (err) throw err;
                        id_categorys = id_categorys.concat(result.insertId + ',');
                    });
                }
            });
        });

        getInsertQuy_mo();
        id_categorys = '';

    }

    function getInsertQuy_mo() {
        var selectTable = "SELECT id, name_quy_mo FROM quy_mo WHERE name_quy_mo = '" + quy_mo + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                var id_quy_mo = result[0].id;
                getInsertCompany(id_quy_mo);
            } else {

                var insertTable = "INSERT INTO quy_mo (name_quy_mo, created_at, updated_at) VALUES ('" + quy_mo + "', '" + date_hour + "', '" + date_hour + "')";

                conn.query(insertTable, function(err, result) {

                    if (err) throw err;
                    var id_quy_mo = result.insertId;
                    getInsertCompany(id_quy_mo);
                });

            }
        });
    }


    function getInsertCompany(id_quy_mo) {

        var selectTable = "SELECT id, name_company FROM company WHERE name_company = '" + name_cong_ty + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                id_company = result[0].id
                getInsertEmployer(id_company);
            } else {
                var insertTable = "INSERT INTO company (logo, name_company, address, id_cities, id_quy_mo, website, introduce, created_at, updated_at) VALUES ('" + logo + "','" + name_cong_ty + "', '" + address + "', '" + id_cities + "', '" + id_quy_mo + "','" + website + "','" + introduce + "', '" + date_hour + "', '" + date_hour + "')";
                conn.query(insertTable, function(err, result) {

                    if (err) throw err;
                    id_company = result.insertId;
                    getInsertEmployer(id_company);
                });

            }
        });
    }


    function getInsertEmployer(id_company) {
        var selectTable = "SELECT id, id_company FROM employers WHERE id_company = '" + id_company + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                id_employer = result[0].id
                getInsertForm_of_work(id_employer);
            } else {
                var insertTable = "INSERT INTO employers (id_company, name_employer, tel_employer, email_employer, email, password, roles, created_at, updated_at) VALUES ('" + id_company + "','" + name_employer + "', '" + tel_employer + "', '" + email_employer + "', '" + email + "','" + password + "', '"+ 1 +"', '" + date_hour + "', '" + date_hour + "')";
                conn.query(insertTable, function(err, result) {
                    if (err) throw err;
                    id_employer = result.insertId;
                    getInsertForm_of_work(id_employer);
                });

            }
        });
    }

    function getInsertForm_of_work(id_employer) {

        var selectTable = "SELECT id, name_form_of_work FROM form_of_work WHERE name_form_of_work = '" + form_of_work + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                var id_form_of_work = result[0].id;
                getInsertExperience(id_employer, id_form_of_work);

            } else {

                var insertTable = "INSERT INTO form_of_work (name_form_of_work, created_at, updated_at) VALUES ('" + form_of_work + "', '" + date_hour + "', '" + date_hour + "')";

                conn.query(insertTable, function(err, result) {
                    if (err) throw err;
                    var id_form_of_work = result.insertId;
                    getInsertExperience(id_employer, id_form_of_work);

                });
            }
        });
    }

    function getInsertExperience(id_employer, id_form_of_work) {

        var selectTable = "SELECT id, name_experience FROM experience WHERE name_experience = '" + experience + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                var id_experience = result[0].id;
                getInsertChuc_vu(id_employer, id_form_of_work, id_experience);
            } else {

                var insertTable = "INSERT INTO experience (name_experience, created_at, updated_at) VALUES ('" + experience + "', '" + date_hour + "', '" + date_hour + "')";

                conn.query(insertTable, function(err, result) {
                    if (err) throw err;
                    var id_experience = result.insertId;
                    getInsertChuc_vu(id_employer, id_form_of_work, id_experience);

                });
            }
        });
    }

    function getInsertChuc_vu(id_employer, id_form_of_work, id_experience) {

        var selectTable = "SELECT id, name_chuc_vu FROM chuc_vu WHERE name_chuc_vu = '" + chuc_vu + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                var id_position = result[0].id;
                getInsertDegree(id_employer, id_form_of_work, id_experience, id_position);
            } else {

                var insertTable = "INSERT INTO chuc_vu (name_chuc_vu, created_at, updated_at) VALUES ('" + chuc_vu + "', '" + date_hour + "', '" + date_hour + "')";

                conn.query(insertTable, function(err, result) {
                    if (err) throw err;
                    var id_position = result.insertId;
                    getInsertDegree(id_employer, id_form_of_work, id_experience, id_position);
                });
            }
        });
    }

    function getInsertDegree(id_employer, id_form_of_work, id_experience, id_position) {

        var selectTable = "SELECT id, name_degree FROM degree WHERE name_degree = '" + degree + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                var id_degree = result[0].id;
                getInsertSalary(id_employer, id_form_of_work, id_experience, id_position, id_degree);

            } else {

                var insertTable = "INSERT INTO degree (name_degree, created_at, updated_at) VALUES ('" + degree + "', '" + date_hour + "', '" + date_hour + "')";

                conn.query(insertTable, function(err, result) {
                    if (err) throw err;
                    var id_degree = result.insertId;
                    getInsertSalary(id_employer, id_form_of_work, id_experience, id_position, id_degree);


                });
            }
        });
    }


    function getInsertSalary(id_employer, id_form_of_work, id_experience, id_position, id_degree) {
        var arr_salary = []
        var arr_salary = salary.split(' ');
        var salary_min = Number(arr_salary[0]);
        var salary_max = Number(arr_salary[3]);
        if (salary_min === 30) {
            salary_max = salary_min;
        }

        var selectTable = "SELECT id, salary_min, salary_max FROM salary WHERE salary_min = " + salary_min + " or salary_max = " + salary_max + "";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;

            if (result.length > 0) {

                var id_salary = result[0].id;
                jobs(id_employer, id_form_of_work, id_experience, id_position, id_degree, id_salary);
            } else {
                var insertTable = "INSERT INTO salary (salary_min, salary_max, created_at, updated_at) VALUES (" + salary_min + "," + salary_max + ", '" + date_hour + "', '" + date_hour + "')";
                conn.query(insertTable, function(err, result) {
                    if (err) throw err;

                    var id_salary = result.insertId;
                    jobs(id_employer, id_form_of_work, id_experience, id_position, id_degree, id_salary);

                });
            }
        })
    }

    function jobs(id_employer, id_form_of_work, id_experience, id_position, id_degree, id_salary) {
        var selectTable = "SELECT id, name FROM jobs WHERE name = '" + name + "'";
        conn.query(selectTable, function(err, result) {
            if (err) throw err;
            if (result.length > 0) {
                console.log("insert bang jobs trung khop thanh cong");
                console.log("=================================");
            } else {

                var insertTable = "INSERT INTO jobs (id_employer, name, id_salary, id_experience, id_degree, number_people, id_position, id_form_of_work, gender, id_category, id_cities, description, Welfare, requirements_other, language, date_expired, status, created_at, updated_at) VALUES ('" + id_employer + "', '" + name + "', '" + id_salary + "', '" + id_experience + "', '" + id_degree + "', '" + number_people + "', '" + id_position + "', '" + id_form_of_work + "', '" + gender + "', '" + id_categorys + "', '" + id_cities + "', '" + description + "', '" + Welfare + "', '" + requirements_other + "', '" + language + "', '" + date_expired + "', '"+ 1 +"', '" + date_hour + "', '" + date_hour + "')";

                conn.query(insertTable, function(err, result) {
                    if (err) throw err;


                    console.log("insert bang jobs thanh cong");
                    console.log("=================================");

                });
            }
        });
    }

    getInserCities('cities', cities);

    console.log(key, link_cong_ty);

    return page;
}

async function scrollToBottom() {
    await new Promise(resolve => {
        const distance = 100; // should be less than or equal to window.innerHeight
        const delay = 100;
        const timer = setInterval(() => {
            document.scrollingElement.scrollBy(0, distance);
            if (document.scrollingElement.scrollTop + window.innerHeight >= document.scrollingElement.scrollHeight) {
                clearInterval(timer);
                resolve();
            }
        }, delay);
    });
}