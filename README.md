#### 复旦大学2018-2019学年春季学期

#### Spring 2019, Fudan University

## Databases 数据库引论 (COMP130010.01) Course Project

The requirement of this project ([course project.pdf](https://github.com/jasha64/DataBase-OnlineJudge/tree/master/course%20project.pdf)) is to build a practical project (based on databases) with complete front and back ends, and I designed this Online Judge (OJ) called DataBase-OnlineJudge.

Considering it's a database course, we're not required to independently develop the components other than database; but as a honor course, we need to go through the full process of developing a project with complete front and back ends. Therefore, I downloaded HUSTOJ(https://github.com/zhblue/hustoj), stripped off its original database component and made use of the remaining. Also, to make this OJ work I used FreeJudger(https://github.com/NsLib/FreeJudger). The majority of my work is to rewrite the database structure from scratch and connect it to the frontend and the judger.

For more information (e.g. database structure) refer to my report [report.pdf](https://github.com/jasha64/DataBase-OnlineJudge/tree/master/report.pdf).



### Structure & Configuration Guide

本OJ运行于Microsoft Windows。This OJ runs on Microsoft Windows.

#### Backend

本OJ的后端由本人独立开发。The backend of DataBase-OnlineJudge is independently designed by me.

安装MySQL Server 8，执行本目录下hustoj.sql即可。

#### Frontend

本OJ的前端来自HUSTOJ。The frontend of DataBase-OnlineJudge is from HUSTOJ. https://github.com/zhblue/hustoj

安装Apache2和php，php启用mbstring和mysqli相关插件。

然后将本htdocs目录下的内容复制到Apache2/htdocs目录下。

最后配置Apache2/htdocs/include/db_info.inc.php中的测试数据路径、数据库用户名、密码等。

#### Judger

本OJ的评测核心来自FreeJudger。OJ Judger is FreeJudger. https://github.com/NsLib/FreeJudger

安装Visual Studio 2010并配置FreeJudger/Debug/config.xml中的测试数据路径、数据库用户名、密码等即可。
