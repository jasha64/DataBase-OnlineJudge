CREATE DATABASE  IF NOT EXISTS `hustoj` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `hustoj`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: hustoj
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `problem`
--

DROP TABLE IF EXISTS `problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `problem` (
  `problem_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `input` mediumtext,
  `output` mediumtext,
  `sample_input` mediumtext,
  `sample_output` mediumtext,
  `spj` tinyint(1) NOT NULL DEFAULT '0',
  `hint` mediumtext,
  `category` varchar(30) DEFAULT NULL,
  `in_date` datetime DEFAULT NULL,
  `time_limit` int(11) NOT NULL,
  `memory_limit` int(11) NOT NULL,
  `ac_count` int(11) DEFAULT NULL,
  `submit_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1005 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem`
--

LOCK TABLES `problem` WRITE;
/*!40000 ALTER TABLE `problem` DISABLE KEYS */;
INSERT INTO `problem` VALUES (1000,'A+B Problem','输入两个整数，计算它们的和。保证输入数据和结果在int范围内。','一行两个整数，空格隔开。','一个整数。','1 1','2',0,NULL,'语言基础','2019-04-22 23:45:44',1,128,3,6),(1001,'开车旅行','小A和小B决定利用假期外出旅行，他们将想去的城市从1到N编号，且编号较小的城市在编号较大的城市的西边，已知各个城市的海拔高度互不相同，记城市i 的海拔高度为Hi，城市i 和城市j 之间的距离d[i,j]恰好是这两个城市海拔高度之差的绝对值，即d[i,j] = |Hi - Hj|。\n旅行过程中，小A和小B轮流开车，第一天小A开车，之后每天轮换一次。他们计划选择一个城市S作为起点，一直向东行驶，并且最多行驶X公里就结束旅行。小A 和小B的驾驶风格不同，小B总是沿着前进方向选择一个最近的城市作为目的地，而小A总是沿着前进方向选择第二近的城市作为目的地（注意：本题中如果当前城 市到两个城市的距离相同，则认为离海拔低的那个城市更近）。如果其中任何一人无法按照自己的原则选择目的城市，或者到达目的地会使行驶的总距离超出X公 里，他们就会结束旅行。 \n在启程之前，小A想知道两个问题：\n1．对于一个给定的X=X0，从哪一个城市出发，小A开车行驶的路程总数 与小B行驶的路程总数的比值最小（如果小B的行驶路程为0，此时的比值可视为无穷大，且两个无穷大视为相等）。如果从多个城市出发，小A开车行驶的路程总 数与小B行驶的路程总数的比值都最小，则输出海拔最高的那个城市。 \n2. 对任意给定的X=Xi 和出发城市Si，小A开车行驶的路程总数以及小B行驶的路程总数。','第一行包含一个整数N，表示城市的数目。 \n第二行有N个整数，每两个整数之间用一个空格隔开，依次表示城市1到城市N的海拔高度，即H1，H2，……，Hn，且每个Hi 都是不同的。 \n第三行包含一个整数X0。\n第四行为一个整数M，表示给定M组Si和Xi。\n接下来的M行，每行包含2个整数Si 和Xi，表示从城市Si 出发，最多行驶Xi 公里。 \n\n对于30%的数据，有1≤N≤20，1≤M≤20；\n对于40%的数据，有1≤N≤100，1≤M≤100； \n对于50%的数据，有1≤N≤100，1≤M≤1,000；\n对于70%的数据，有1≤N≤1,000，1≤M≤10,000； \n对于100%的数据，有1≤N≤100,000，1≤M≤10,000，-1,000,000,000≤Hi≤1,000,000,000，0≤X0≤1,000,000,000，1≤Si≤N，0≤Xi≤1,000,000,000，数据保证Hi 互不相同。','输出共M+1行。 \n第一行包含一个整数S0，表示对于给定的X0，从编号为S0的城市出发，小A开车行驶的路程总数与小B行驶的路程总数的比值最小。 \n接下来的M行，每行包含2个整数，之间用一个空格隔开，依次表示在给定的Si 和Xi下小A行驶的里程总数和小B行驶的里程总数。','4\n2 3 1 4\n3\n4\n1 3\n2 3\n3 3\n4 3\n','1\n1 1\n2 0\n0 0\n0 0\n',0,NULL,'数据结构','2019-04-26 00:58:58',1,128,2,2),(1002,'瑞士轮','2*N名编号为1~2N的选手共进行R轮比赛。每轮比赛开始前，以及所有比赛结束后，都会按照总分从高到低对选手进行一次排名。选手的总分为第一轮开始前的初始分数加上已参加过的所有比赛的得分和。总分相同的，约定编号较小的选手排名靠前。 \n每轮比赛的对阵安排与该轮比赛开始前的排名有关：第1名和第2名、第3名和第4名、……、第2K-1名和第2K名、……、第2N-1名和第2N名，各进行 一场比赛。每场比赛胜者得 1分，负者得0分。也就是说除了首轮以外，其它轮比赛的安排均不能事先确定，而是要取决于选手在之前比赛中的表现。 \n现给定每个选手的初始分数及其实力值，试计算在R轮比赛过后，排名第Q的选手编号是多少。我们假设选手的实力值两两不同，且每场比赛中实力值较高的总能获胜。','输入的第一行是三个正整数N、R、Q，每两个数之间用一个空格隔开，表示有2*N名选手、R轮比赛，以及我们关心的名次Q。 \n第二行是2*N个非负整数s1，s2，…，s2N，每两个数之间用一个空格隔开，其中si表示编号为i的选手的初始分数。 \n第三行是2*N个正整数w1，w2，…，w2N，每两个数之间用一个空格隔开，其中wi表示编号为i的选手的实力值。 \n\n对于 30%的数据，1 ≤ N≤ 100； \n对于 50%的数据，1 ≤ N≤ 10,000； \n对于 100%的数据， 1 ≤ N≤ 100,000， 1 ≤ R≤ 50， 1 ≤ Q≤ 2N， 0 ≤ s1, s2, …, s2N ≤ 1e8\n， 1 ≤ w1, w2, …, w2N ≤ 1e8','输出只有一行，包含一个整数，即R轮比赛结束后，排名第Q的选手的编号。','2 4 2\n7 6 6 7\n10 5 20 15\n','1\n',0,NULL,NULL,'2019-04-30 00:33:52',1,128,3,4),(1003,'疫情控制','H国有n个城市，这n个城市用n-1条双向道路相互连通构成一棵树，1号城市是首都，也是树中的根节点。 \r\nH国的首都爆发了一种危害性极高的传染 病。当局为了控制疫情，不让疫情扩散到边境城市（叶子节点所表示的城市），决定动用军队在一些城市建立检查点，使得从首都到边境城市的每一条路径上都至少 有一个检查点，边境城市也可以建立检查点。但特别要注意的是，首都是不能建立检查点的。 \r\n现在，在H国的一些城市中已经驻扎有军队，且一个城市可以驻扎多个军队。一支军队可以在有道路连接的城市间移动，并在除首都以外的任意一个城市建立检查 点，且只能在一个城市建立检查点。一支军队经过一条道路从一个城市移动到另一个城市所需要的时间等于道路的长度（单位：小时）。 \r\n请问最少需要多少个小时才能控制疫情。注意：不同的军队可以同时移动。','第一行一个整数n，表示城市个数。 \r\n接下来的n-1行，每行3个整数，u、v、w，每两个整数之间用一个空格隔开，表示从城市u到城市v有一条长为w的道路。数据保证输入的是一棵树，且根节点编号为1。 \r\n接下来一行一个整数m，表示军队个数。 \r\n接下来一行m个整数，每两个整数之间用一个空格隔开，分别表示这m个军队所驻扎的城市的编号。 \r\n\r\n【数据范围】 \r\n保证军队不会驻扎在首都。 \r\n对于20%的数据，2≤ n≤ 10； \r\n对于40%的数据，2 ≤n≤50，0<w <10^5； \r\n对于60%的数据，2 ≤ n≤1000，0<w <10^6； \r\n对于80%的数据，2 ≤ n≤10&#44;000； \r\n对于100%的数据，2≤m≤n≤50&#44;000，0<w <10^9。','共一行，包含一个整数，表示控制疫情所需要的最少时间。如果无法控制疫情则输出-1。','4\r\n1 2 1\r\n1 3 2\r\n3 4 3\r\n2\r\n2 2\r\n','3',0,'','数据结构','2019-05-05 16:32:30',1,128,0,1);
/*!40000 ALTER TABLE `problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submission`
--

DROP TABLE IF EXISTS `submission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `submission` (
  `submission_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `language` tinyint(4) NOT NULL,
  `code_len` int(11) NOT NULL,
  `run_time` int(11) NOT NULL DEFAULT '0',
  `run_memory` int(11) NOT NULL DEFAULT '0',
  `result` tinyint(4) NOT NULL,
  `pass_rate` float NOT NULL DEFAULT '0',
  `submit_time` datetime NOT NULL,
  `source` text NOT NULL,
  `err_info` text,
  PRIMARY KEY (`submission_id`),
  KEY `problem_id_idx` (`problem_id`),
  KEY `username_idx` (`username`),
  CONSTRAINT `problem_id` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`),
  CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submission`
--

LOCK TABLES `submission` WRITE;
/*!40000 ALTER TABLE `submission` DISABLE KEYS */;
INSERT INTO `submission` VALUES (1,1000,'mayijun',1,133,0,532,4,1,'2019-04-23 18:56:29','#include <iostream>\r using namespace std;\r \r int main()\r {\r 	int a, b;\r 	\r 	cin >> a >> b;\r 	cout << a+b << endl;\r 	\r 	return 0;\r }\r ',NULL),(2,1000,'mayijun',1,147,0,532,6,0,'2019-04-26 16:18:18','#include <iostream>\r\n using namespace std;\r\n \r\n int main()\r\n {\r\n 	int a, b;\r\n 	\r\n 	cin >> a >> b;\r\n 	cout << a+b-1 << endl;\r\n 	\r\n 	return 0;\r\n }\r\n ',NULL),(3,1001,'mayijun',1,3632,46,58872,4,1,'2019-04-26 16:25:34','#include <iostream>\r\n#include <algorithm>\r\n#include <cstdio>\r\n#include <set>\r\n#include <iterator>\r\nusing namespace std;\r\n\r\nconst int N = 100007;\r\nstruct City\r\n{\r\n	int n, h;\r\n	friend bool operator < (const City& a, const City& b) {return a.h < b.h;}\r\n} c[N];\r\nset<City> s;\r\nset<City>::iterator I;\r\nint h[N], f1[N], f2[N];\r\nstruct Data\r\n{\r\n	int d;\r\n	long long a, b, x;\r\n	Data() {d = a = b = x = 0;}\r\n} f[N][18];\r\n\r\ntemplate <typename T> inline T Abs(T x) {return x < 0 ? -x : x;}\r\ninline int Dist(int a, int b) {return Abs(h[a] - h[b]);}\r\ninline int Dist(set<City>::iterator A, set<City>::iterator B) {return Abs(A -> h - B -> h);}\r\ninline int Dist(int a, set<City>::iterator I) {return Abs(h[a] - I -> h);}\r\nvoid Special_Work()\r\n{\r\n	int i;\r\n	scanf(\"%*d%*d\");\r\n	cout << 1 << endl;\r\n	cin >> i;\r\n	while (i--) printf(\"0 0\\n\");\r\n}\r\ninline void Update(int i, int j)\r\n{\r\n	if (f1[i] == -1 || Dist(i, j) < Dist(i, f1[i]) ||\r\n	(Dist(i, j) == Dist(i, f1[i]) && h[j] < h[f1[i]])) {f2[i] = f1[i]; f1[i] = j;}\r\n	else if (f2[i] == -1 || Dist(i, j) < Dist(i, f2[i]) ||\r\n	(Dist(i, j) == Dist(i, f2[i]) && h[j] < h[f2[i]])) f2[i] = j;\r\n}\r\ninline void Update(int i, set<City>::iterator I)\r\n{\r\n	if (f1[i] == -1 || Dist(i, I) < Dist(i, f1[i]) ||\r\n	(Dist(i, I) == Dist(i, f1[i]) && I -> h < h[f1[i]])) {f2[i] = f1[i]; f1[i] = I -> n;}\r\n	else if (f2[i] == -1 || Dist(i, I) < Dist(i, f2[i]) ||\r\n	(Dist(i, I) == Dist(i, f2[i]) && I -> h < h[f2[i]])) f2[i] = I -> n;\r\n}\r\n\r\nint main()\r\n{\r\n	int n, m, x0, i, j, k, x, s0 = 0;\r\n	long long a, b, A = 0, B = 0;\r\n	\r\n	cin >> n;\r\n	if (n == 1) {Special_Work(); return 0;}\r\n	for (i = 1; i <= n; ++i) {scanf(\"%d\", &h[i]); c[i].h = h[i]; c[i].n = i;}\r\n	s.insert(c[n]);\r\n	f1[n - 1] = n; s.insert(c[n - 1]);\r\n	if (n <= 4)\r\n		for (i = n - 2; i > 0; --i)\r\n		{\r\n			f1[i] = f2[i] = -1;\r\n			for (j = i + 1; j <= n; ++j) Update(i, j);\r\n		}\r\n	else {\r\n		s.insert(c[n - 2]); s.insert(c[n - 3]);\r\n		for (i = n - 2; i > n - 4; --i)\r\n		{\r\n			f1[i] = f2[i] = -1;\r\n			for (j = i + 1; j <= n; ++j) Update(i, j);\r\n		}\r\n		for (i = n - 4; i > 0; --i)\r\n		{\r\n			f1[i] = f2[i] = -1;\r\n			s.insert(c[i]);\r\n			I = s.find(c[i]);\r\n			if ((++I) != s.end())\r\n			{\r\n				Update(i, I);\r\n				if ((++I) != s.end()) {Update(i, I); --I;}\r\n				--I;\r\n			}\r\n			if (I != s.begin())\r\n			{\r\n				Update(i, --I);\r\n				if (I != s.begin()) Update(i, --I);\r\n			}\r\n		}\r\n	}\r\n	for (i = n - 2; i > 0; --i)\r\n	{\r\n		f[i][0].d = f1[f2[i]];\r\n		f[i][0].x = Dist(f1[f2[i]], f2[i]) + Dist(f2[i], i);\r\n		f[i][0].b = Dist(f1[f2[i]], f2[i]);\r\n		f[i][0].a = Dist(f2[i], i);\r\n	}\r\n	for (j = 1; (1 << j) < n; ++j)\r\n		for (i = 1; i + (1 << j) <= n; ++i)\r\n		{\r\n			if (!(f[i][j].d = f[f[i][j - 1].d][j - 1].d)) continue;\r\n			f[i][j].a = f[f[i][j - 1].d][j - 1].a + f[i][j - 1].a;\r\n			f[i][j].b = f[f[i][j - 1].d][j - 1].b + f[i][j - 1].b;\r\n			f[i][j].x = f[f[i][j - 1].d][j - 1].x + f[i][j - 1].x;\r\n		}\r\n	\r\n	cin >> x0;\r\n	for (i = n; i > 0; --i)\r\n	{\r\n		x = a = b = 0;\r\n		k = i;\r\n		for (j = 17; j >= 0; --j)\r\n			if (f[k][j].d && x + f[k][j].x <= x0)\r\n				{a += f[k][j].a; b += f[k][j].b; x += f[k][j].x; k = f[k][j].d;}\r\n		if (f2[k] && x + Dist(k, f2[k]) <= x0) {a += Dist(k, f2[k]); x += Dist(k, f2[k]);}\r\n		if (!s0 || (b && !B) || a * B < b * A || (a * B == b * A && h[i] > h[s0])) {A = a; B = b; s0 = i;}\r\n	}\r\n	cout << s0 << endl;\r\n	\r\n	cin >> m;\r\n	while (m--)\r\n	{\r\n		scanf(\"%d%d\", &k, &x0);\r\n		x = a = b = 0;\r\n		for (j = 17; j >= 0; --j)\r\n			if (f[k][j].d && x + f[k][j].x <= x0)\r\n				{a += f[k][j].a; b += f[k][j].b; x += f[k][j].x; k = f[k][j].d;}\r\n		if (f2[k] && x + Dist(k, f2[k]) <= x0) {a += Dist(k, f2[k]); x += Dist(k, f2[k]);}\r\n		printf(\"%lld %lld\\n\", a, b);\r\n	}\r\n	\r\n	return 0;\r\n}\r\n',NULL),(4,1002,'mayijun',1,1169,234,9928,4,1,'2019-04-30 00:44:53','#include <iostream>\r\n#include <algorithm>\r\nusing namespace std;\r\n\r\nconst int N = 200007;\r\nint n;\r\nstruct people\r\n{\r\n	int num, scr, str;\r\n	\r\n	friend bool operator < (const people& a, const people& b)\r\n	{\r\n		if (a.scr != b.scr) return a.scr > b.scr;\r\n		else return a.num < b.num;\r\n	}\r\n} p[N], win[N], lose[N], cache[N];\r\n\r\ninline void Merge()\r\n{\r\n	int top1 = 1, top2 = 1, top = 1;\r\n	while (top1 <= n || top2 <= n)\r\n	{\r\n		if (top2 > n || (top1 <= n && win[top1] < lose[top2])) p[top++] = win[top1++];\r\n		else p[top++] = lose[top2++];\r\n	}\r\n}\r\n\r\nint main()\r\n{\r\n	int m, r, q;\r\n	int i, j;\r\n	\r\n	ios::sync_with_stdio(false);\r\n	cin >> n >> r >> q;\r\n	m = n << 1;\r\n	for (i = 1; i <= m; i++)\r\n	{\r\n		cin >> p[i].scr;\r\n		p[i].num = i;\r\n	}\r\n	for (i = 1; i <= m; i++) cin >> p[i].str;\r\n	\r\n	sort(p + 1, p + m + 1);\r\n	for (i = 0; i < r; i++)\r\n	{\r\n		for (j = 1; j <= n; j++)\r\n			if (p[j * 2].str > p[j * 2 - 1].str)\r\n			{\r\n				p[j * 2].scr++;\r\n				win[j] = p[j * 2];\r\n				lose[j] = p[j * 2 - 1];\r\n			}\r\n			else {\r\n				p[j * 2 - 1].scr++;\r\n				win[j] = p[j * 2 - 1];\r\n				lose[j] = p[j * 2];\r\n			}\r\n		Merge();\r\n	}\r\n	sort(p + 1, p + m + 1);\r\n	\r\n	cout << p[q].num << endl;\r\n	\r\n	return 0;\r\n}\r\n',NULL),(5,1002,'mayijun',1,819,1265,2884,7,0.1,'2019-04-30 00:45:19','#include<iostream>\r\n#include<algorithm>\r\nusing namespace std;\r\nstruct stu\r\n{\r\n    int No,fen,shili;\r\n};\r\nconst int N(100001);\r\nstu a[2*N];\r\nbool comp(const stu &x,const stu &y)\r\n{\r\n    if (x.fen!=y.fen) return x.fen>y.fen;\r\n    return x.No<y.No;\r\n}\r\nint n;\r\nvoid solve()\r\n{\r\n    for (int i=0;i<n;i++)\r\n        if (a[2*i].shili>a[2*i+1].shili)\r\n            a[2*i].fen++;\r\n        else a[2*i+1].fen++;\r\n    sort(a,a+2*n,comp);\r\n}\r\nint main()\r\n{\r\n    int r,q;\r\n    cin>>n>>r>>q;\r\n    for (int i=0;i<2*n;i++) a[i].No=i+1;\r\n    for (int i=0;i<2*n;i++) cin>>a[i].fen;\r\n    for (int i=0;i<2*n;i++) cin>>a[i].shili;\r\n    sort(a,a+2*n,comp);\r\n    for (int i=0;i<r;i++)\r\n        solve();\r\n    cout<<a[q-1].No<<endl;\r\n    return 0;\r\n}\r\n    ',NULL),(6,1000,'test1',1,125,0,532,4,1,'2019-05-04 19:20:56','#include <iostream>\r\nusing namespace std;\r\nint main()\r\n{\r\n	int a, b;\r\n	cin >> a >> b;\r\n	cout << a+b << endl;\r\n	return 0;\r\n}\r\n',NULL),(7,1002,'test1',1,1138,1031,9928,4,1,'2019-05-05 13:29:07','#include <iostream>\r\n#include <algorithm>\r\nusing namespace std;\r\n\r\nconst int N = 200007;\r\nint n;\r\nstruct people\r\n{\r\n	int num, scr, str;\r\n	\r\n	friend bool operator < (const people& a, const people& b)\r\n	{\r\n		if (a.scr != b.scr) return a.scr > b.scr;\r\n		else return a.num < b.num;\r\n	}\r\n} p[N], win[N], lose[N], cache[N];\r\n\r\ninline void Merge()\r\n{\r\n	int top1 = 1, top2 = 1, top = 1;\r\n	while (top1 <= n || top2 <= n)\r\n	{\r\n		if (top2 > n || (top1 <= n && win[top1] < lose[top2])) p[top++] = win[top1++];\r\n		else p[top++] = lose[top2++];\r\n	}\r\n}\r\n\r\nint main()\r\n{\r\n	int m, r, q;\r\n	int i, j;\r\n	\r\n	cin >> n >> r >> q;\r\n	m = n << 1;\r\n	for (i = 1; i <= m; i++)\r\n	{\r\n		cin >> p[i].scr;\r\n		p[i].num = i;\r\n	}\r\n	for (i = 1; i <= m; i++) cin >> p[i].str;\r\n	\r\n	sort(p + 1, p + m + 1);\r\n	for (i = 0; i < r; i++)\r\n	{\r\n		for (j = 1; j <= n; j++)\r\n			if (p[j * 2].str > p[j * 2 - 1].str)\r\n			{\r\n				p[j * 2].scr++;\r\n				win[j] = p[j * 2];\r\n				lose[j] = p[j * 2 - 1];\r\n			}\r\n			else {\r\n				p[j * 2 - 1].scr++;\r\n				win[j] = p[j * 2 - 1];\r\n				lose[j] = p[j * 2];\r\n			}\r\n		Merge();\r\n	}\r\n	sort(p + 1, p + m + 1);\r\n	\r\n	cout << p[q].num << endl;\r\n	\r\n	return 0;\r\n}\r\n',NULL),(8,1000,'test2',1,127,0,532,6,0,'2019-05-05 13:30:14','#include <iostream>\r\nusing namespace std;\r\nint main()\r\n{\r\n	int a, b;\r\n	cin >> a >> b;\r\n	cout << a+b-1 << endl;\r\n	return 0;\r\n}\r\n',NULL),(9,1000,'test2',1,125,0,532,4,1,'2019-05-05 13:30:22','#include <iostream>\r\nusing namespace std;\r\nint main()\r\n{\r\n	int a, b;\r\n	cin >> a >> b;\r\n	cout << a+b << endl;\r\n	return 0;\r\n}\r\n',NULL),(10,1002,'test2',1,1138,984,9932,4,1,'2019-05-05 13:30:35','#include <iostream>\r\n#include <algorithm>\r\nusing namespace std;\r\n\r\nconst int N = 200007;\r\nint n;\r\nstruct people\r\n{\r\n	int num, scr, str;\r\n	\r\n	friend bool operator < (const people& a, const people& b)\r\n	{\r\n		if (a.scr != b.scr) return a.scr > b.scr;\r\n		else return a.num < b.num;\r\n	}\r\n} p[N], win[N], lose[N], cache[N];\r\n\r\ninline void Merge()\r\n{\r\n	int top1 = 1, top2 = 1, top = 1;\r\n	while (top1 <= n || top2 <= n)\r\n	{\r\n		if (top2 > n || (top1 <= n && win[top1] < lose[top2])) p[top++] = win[top1++];\r\n		else p[top++] = lose[top2++];\r\n	}\r\n}\r\n\r\nint main()\r\n{\r\n	int m, r, q;\r\n	int i, j;\r\n	\r\n	cin >> n >> r >> q;\r\n	m = n << 1;\r\n	for (i = 1; i <= m; i++)\r\n	{\r\n		cin >> p[i].scr;\r\n		p[i].num = i;\r\n	}\r\n	for (i = 1; i <= m; i++) cin >> p[i].str;\r\n	\r\n	sort(p + 1, p + m + 1);\r\n	for (i = 0; i < r; i++)\r\n	{\r\n		for (j = 1; j <= n; j++)\r\n			if (p[j * 2].str > p[j * 2 - 1].str)\r\n			{\r\n				p[j * 2].scr++;\r\n				win[j] = p[j * 2];\r\n				lose[j] = p[j * 2 - 1];\r\n			}\r\n			else {\r\n				p[j * 2 - 1].scr++;\r\n				win[j] = p[j * 2 - 1];\r\n				lose[j] = p[j * 2];\r\n			}\r\n		Merge();\r\n	}\r\n	sort(p + 1, p + m + 1);\r\n	\r\n	cout << p[q].num << endl;\r\n	\r\n	return 0;\r\n}\r\n',NULL),(11,1000,'test3',1,127,0,528,6,0,'2019-05-05 13:31:25','#include <iostream>\r\nusing namespace std;\r\nint main()\r\n{\r\n	int a, b;\r\n	cin >> a >> b;\r\n	cout << a+b-1 << endl;\r\n	return 0;\r\n}\r\n',NULL);
/*!40000 ALTER TABLE `submission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `username` char(20) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `privilege` tinyint(1) DEFAULT '0',
  `submit_count` int(11) DEFAULT '0',
  `ac_count` int(11) DEFAULT '0',
  `nick` varchar(100) DEFAULT NULL,
  `school` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('mayijun','IQJwiYxvD2tqV3HFYgZbUrQDtZQzYzI3',1,7,3,'horse',NULL,'jasha@qq.com'),('test1','LJohlC/lR1+2NlByyWkfrYBhiFA1ZTEw',0,2,2,'test1','',''),('test2','grZRyHENECxOtWY39Hu6zg362tIzNjhk',0,3,2,'test2','',''),('test3','omVpdmecD+/U9HIFsOHI9aQJUkU3MmRj',0,1,0,'test3','','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-11 16:08:06
