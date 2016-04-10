-- MySQL dump 10.13  Distrib 5.7.10, for osx10.9 (x86_64)
--
-- Host: localhost    Database: reason_in_revolt
-- ------------------------------------------------------
-- Server version	5.7.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_authors`
--

DROP TABLE IF EXISTS `blog_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_authors`
--

LOCK TABLES `blog_authors` WRITE;
/*!40000 ALTER TABLE `blog_authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comments` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` tinytext,
  `email` tinytext,
  `website` tinytext,
  `postId` int(11) DEFAULT NULL,
  `body` text,
  `title` tinytext,
  `notify` tinytext,
  PRIMARY KEY (`commentId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
INSERT INTO `blog_comments` VALUES (1,'2012-05-21 05:57:43','cheap England shirts','mark.r.rossetti@bc.edu','www.footballmall.org/england-football-shirts-c-8_16.html',1,'\"C Ronaldo must take the ball, because his goals in exchange for the trophy, although he did not like last season as top scorer.\" Mourinho said, \"Messi has scored 50 goals,However, these goals worthless, not being able to exchange the trophy last season, Messi rely on champion to get a Golden Globe, this year it is our turn. \"','','false'),(2,'2012-05-21 06:06:17','football shirts','sara1@gieske.us','www.footballmall.org',2,'Barcelona ready to Drogba out of a two-year, annual salary of Â£ 5,000,000 of the lucrative contract, Chelsea side for the World of Warcraft out of a two-year contract, Abu intend to leave the World of Warcraft.','','false'),(3,'2012-05-21 06:06:27','football shirts','sara1@gieske.us','www.footballmall.org',2,'Barcelona ready to Drogba out of a two-year, annual salary of Â£ 5,000,000 of the lucrative contract, Chelsea side for the World of Warcraft out of a two-year contract, Abu intend to leave the World of Warcraft.','','false'),(4,'2012-07-24 09:08:14','Real Madrid soccer jersey 2012','yug@yahoo.com','www.9soccers.com/real-madrid-c-55_59.html',1,'You can\'t force people to not do anything. But you can reduce they do it. I think racism has reduce more.','','false');
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `postId` int(11) NOT NULL AUTO_INCREMENT,
  `titleId` tinytext,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` tinytext,
  `body` text,
  PRIMARY KEY (`postId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'one-about-football-and-racism-1','2012-02-12 12:27:22','One about football and racism','&lt;?xml version=&quot;1.0&quot;?&gt;\n&lt;article&gt;&lt;para&gt;&lt;![CDATA[Two recent high-profile incidents in English football have raised the spectre once again of racism in the sport. One is the forthcoming trial of Chelsea&#039;s John Terry on charges of racially abusing an opponent. The other is the similar incident involving Luis Suarez and Patrice Evra of Liverpool and Manchester United respectively.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The first of these became even more significant when it apparently forced the resignation of the coach of the English national team, Fabio Capello, over the decision of the FA to strip Terry of the captaincy pending his trial. The latter incident became even more highly-charged yesterday when, only a few days after Suarez completed an eight-match ban for the incident, Liverpool and Manchester United met in a League match and Suarez refused the customary pre-match handshake with Evra. This brought harsh words from United manager Alex Ferguson, who went on to suggest that Liverpool Football Club have a particular problem with racism. Liverpool manager Kenny Dalglish on the other hand continued to support his player.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[As a football club, Liverpool certainly have a case to answer. The insistence, by Dalglish in particular, that Suarez remained innocent throughout all the proceedings was shameful and made the situation worse. The response of the club has continued to be one of playing the victim. When the squad and manager emerged pre-match in t-shirts proclaiming their support for the player shortly after the ban was imposed one&#039;s heart could only sink with the recognition that the club just didn&#039;t get it. Their actions have done much to ensure that racism has been shown to be alive within football despite the efforts of many and the very real progress the game has made over the last couple of decades.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[For me, and this appeared to be what Ferguson had in mind when he spoke of the history of racism in Liverpool, my mind went back some twenty three years and the publication of Out of His Skin, by Dave Hill. This fine book, republished by WSC Books in 2001, described the arrival of John Barnes at Anfield and cleverly interwove this with Barnes&#039; relatively privileged upbringing, the history of Liverpool as a port with its connections to the slave trade and the city&#039;s accompanying racism, which manifested itself in two clubs - Everton as well as Liverpool - who were always painfully slow to accept black players as part of the modern game. The significance, at the time, of Liverpool signing a black player (though Barnes was not in fact the first) is hard to imagine today. The books tells of Liverpool fans going to games at Goodison Park rather than watch their team field a black player. And the cover shows Barnes deftly back-heeling a banana from the pitch which had been thrown at him from the crowd.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The book caused quite some unease at Liverpool Football Club on its publication. Quotes from Kop hero Tommy Smith which appeared in the book particularly illustrate the problem. In an interview he gave to Hill, his casual racism was shocking and, in an introduction to the new edition, Hill describes how both Smith and Liverpool chairman at the time Peter Robinson responded. Smith threatened legal action, whilst remaining bewildered as to what he had actually done wrong, whilst Robinson declined to speak to him saying &quot;when someone throws a brick through your window, you don&#039;t invite them in for a cup of tea&quot;.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[It is alarming how, despite the giant strides that have been made since, the Suarez incident suggest some of the fundamental problems remain. The parallels with Dalglish today are uneasy to say the least. The siege mentality that has sprung up at the club, their insistence on themselves and their player as being the victim in the whole affair and, above all, their seeming to remain unaware that they have done anything wrong make uncomfortable parallels with those far off, shameful days.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Never has there been a more appropriate time for that book to be re-read.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[]]&gt;&lt;/para&gt;&lt;/article&gt;\n'),(2,'why-i-won039t-be-buying-the-sun-on-sunday-2','2012-02-26 21:14:32','Why I won&#039;t be buying The Sun on Sunday','&lt;?xml version=&quot;1.0&quot;?&gt;\n&lt;article&gt;&lt;para&gt;&lt;![CDATA[From today a new title can be found on Britain&#039;s news-racks. Called &lt;span class=&quot;namedTitle&quot;&gt;The Sun on Sunday&lt;/span&gt; it is, depending on your point of view, a Sunday version of Britain&#039;s favourite daily or the now defunct &lt;span class=&quot;namedTitle&quot;&gt;News of the World&lt;/span&gt; under a different name. Featuring columnists as wide-ranging as Katie Price, Nancy Dell&#039;Olio and Toby Young it&#039;s clearly a mix of celebrity-obsessed trivia and right-wing tub-thumping. Even the Archbishop of York, John Sentamu, has signed up and his truly bizarre first column (reproduced on his own &lt;a class=&quot;newWindow&quot; href=&quot;http://www.archbishopofyork.org/articles.php/2366/celebrating-new-beginnings&quot;&gt;website&lt;/a&gt;) is as close as you&#039;ll get to God himself giving the project the thumbs up.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Needless to say, a paper from the News International stable, released just seven months after the closure of the &lt;span class=&quot;namedTitle&quot;&gt;News of the World&lt;/span&gt; following the disclosure of its phone-hacking activities, was always going to draw opposition. And so it has. People have pledged not to buy it for a number of reasons. Because &lt;span class=&quot;namedTitle&quot;&gt;The Sun&lt;/span&gt; and the &lt;span class=&quot;namedTitle&quot;&gt;News of the World&lt;/span&gt; between them have trivialised our media with an obsession with celebrity culture, because of the phone-hacking scandal - particularly that concerning Millie Dowler - or because of the power of these papers which has reached far into successive UK governments. In Liverpool &lt;span class=&quot;namedTitle&quot;&gt;The Sun&lt;/span&gt;&#039;s reporting after the Hillsborough disaster has ensured that it retains the enmity of those who lost loved ones on that day.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[For me it&#039;s a bit more personal. Twenty six years ago Rupert Murdoch moved the production of four British newspaper titles - &lt;span class=&quot;namedTitle&quot;&gt;The Sun&lt;/span&gt;, the &lt;span class=&quot;namedTitle&quot;&gt;Times&lt;/span&gt;, &lt;span class=&quot;namedTitle&quot;&gt;News of the World&lt;/span&gt; and &lt;span class=&quot;namedTitle&quot;&gt;Sunday Times&lt;/span&gt; - into a purpose-built plant at Wapping, East London. As part of the move he sacked 6,000 printers, journalists and other staff and employed non-union labour to replace them, largely helped by the electricians union, EEPTU, led by Eric Hammond in a move that would see them thrown out of the TUC.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[I was just starting work in the print industry and was a member of the National Graphical Association (NGA). This union, together with SOGAT and the NUJ, led the protests against Murdoch. This dispute, following the miners&#039; strike a couple of years before, had a significance outside the print industry. It was all part of the agenda of the Thatcher government to roll back the influence of the trade unions from British industry - an ideological battle that for me was a fundamental attack on core beliefs.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[I participated in protests outside the plant a few times but it was clear that this was an operation planned with military precision and, with the assistance of Her Majesty&#039;s Constabulary, there was only going to be one winner. And, after a year, so it proved as Murdoch emerged victorious. The new plant was built like a fortress, surrounded by razor wire and the surrounding streets were used as a maze from which lorries would periodically emerge into streets cleared by the police bearing the provocative slogan &quot;&lt;span class=&quot;namedTitle&quot;&gt;The Sun&lt;/span&gt; keeps on trucking&quot;. That&#039;s the thing about people like Murdoch: not only was he carrying out Thatcher&#039;s agenda, he just had to rub your nose in it as well.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Of course there have been industrial disputes before and since and a temporary boycott of this or that product seems to be part of my daily life. But this one just won&#039;t go away. Logically I tell myself to let it go but I still shudder when I see someone buying one of those titles. And to make matters worse, Murdoch has continued his grip on our cultural life with his ownership of Sky, and through that the slow strangulation, in my view, of English football. There can be very few people in the UK that don&#039;t put a little bit of money into this man&#039;s pocket.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[So, should I let this go? Probably. But Murdoch has a unique place in my personal rogues&#039; gallery. And a world that is prepared to allow someone like him to have so much influence and control over so much of peoples&#039; lives is a world that has a long way to go.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[]]&gt;&lt;/para&gt;&lt;/article&gt;\n'),(3,'the-responsive-manifesto-3','2012-08-18 21:37:19','The Responsive Manifesto','&lt;?xml version=&quot;1.0&quot;?&gt;\n&lt;article&gt;&lt;para&gt;&lt;![CDATA[A spectre is haunting the world wide web - the spectre of Responsive Web Design. Well not quite perhaps, but it is now a little over two years since the term was coined by Ethan Marcotte in an article on the blog A List Apart. This article was later expanded into a book, published by A Book Apart in July last year, since when the idea has spread rapidly amongst designers and developers and I for one have become an enthusiast.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[In this post I want to put the concept of Responsive Web Design into context - how and why it has become such a big issue over the last couple of years, explain briefly what it is and how it is achieved and finally discuss some of the criticisms that have been made of it, and why I believe these tend to fundamentally misunderstand the concept.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The main driving force behind the development of the approach has been the increased use of smaller, mobile devices to view online content over the last few years. It is commonly estimated that somewhere around the year of 2014 the use of mobile devices will outstrip desktop devices for viewing online content.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Initially, the main option for developers was to build a dedicated mobile site. The main drawback to this is that it requires the user to be redirected once their device has been recognised and with the number of available mobile devices increasing at a phenomenal rate it is just impossible to keep up. Not only that but the range of different screen sizes and capabilities of these devices is increasing in a wholly unpredictable way.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[It is this dilemma which inspired Marcotte to propose the solution of a site which responds to the device on which it is being viewed in a way that makes sense on that device. There are a number of examples of this - but probably the first major site to use it was the Boston Globe. Looking at this on a desktop and mobile browser illustrates how the same content can be maximised for the device being used to view it.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[This is made possible by coding the site within a flexible grid, able to respond to the dimensions of the viewport of the device, and using media queries - new to the W3C CSS3 specification - to dynamically trigger changes to the layout based upon various attributes of the display device, such as its width, orientation or aspect ratio.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[But more importantly, to me at least, is the philosophy behind this approach. In the article and the book Ethan Marcotte is not just presenting a &#039;how to&#039; but is also positing a change in our way of thinking about the web. In this, his starting point is an article by John Allsopp, A Dao of Web Design, which appeared on A List Apart some ten years earlier.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The main point Marcotte takes from this is that developments from one media to another inevitably see some elements of the old carried on into the new, even after they have ceased to make sense. This can be best understood by considering parallel developments in other media such as how theatre gave rise to cinema. In its early days films were essentially made by placing a camera in front of actors in a theatrical setting. As the medium evolved - both through technical advances, and through its own language becoming better understood - it gradually created its own ways of doing things, casting off the redundant values of its ancestor.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[When applied to web, this refers to how this medium has developed out of print and borrows from it notions such as a clearly defined space - the printed page - in which to work and others, such as &#039;masthead&#039;, &#039;white-space&#039;, &#039;leading&#039; and &#039;fold&#039;. All of this must be jettisoned in favour of web defining its own rules; what have been seen hitherto as &#039;limitations&#039; of the web, as against print, should instead be seen as strengths.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[So to the criticisms. I&#039;ll cover some of the main ones I have come across here, which all have a certain degree of validity, but for me all miss the essential point.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Broadly speaking, there are three main strands of criticism that I have noticed. The first of these argue that Responsive Design is not as good as a dedicated mobile site because it is difficult to optimise certain elements (especially images) for an unknown device. This is an important point when considering the potentially limited bandwidth available to mobile devices and the image-heavy nature of many desktop sites. Whilst there are discussions around how to better mark up images in HTML - including suggestions to introduce a &#039;picture&#039; tag along the lines of &#039;video&#039; and &#039;audio&#039; ones - it remains the case that there is no easy way to serve up smaller images to mobile devices in a responsive site.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Another is that the approach mixes the concepts of the device and the context in which it is used. In other words it is not just about screen sizes but how and when people use the device. Think of a restaurant site for instance. At home your concern may be to find a good restaurant for an evening out. Detailed descriptions of menus and so on will be more appropriate than when you are on the move and your needs are more basic: where is it? Is it open? What&#039;s the phone number? A dedicated mobile site, it is argued, is more able to serve up aspects of the content appropriate to the context in which it is viewed.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[It is also argued that a responsive approach can have a negative impact on the user experience when elements move from one place to another, less familiar one. This is, to my mind, the most convincing argument against a responsive approach - though not one that is unique to it: a dedicated mobile site is subject to similar criticisms.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Valid criticisms all. But they serve to highlight the way that the rise of the mobile device has thrown the whole game wide open. Of course large images should not clog up a user&#039;s bandwidth on a mobile device, but look again at the &lt;span class=&quot;namedTitle&quot;&gt;Boston Globe&lt;/span&gt; site, preferably on a desktop browser and change the size of the viewport. Image sizes do not change that much between a large or small sized browser window. The design, created with the mobile device foremost in mind, does not call for large images. If your design calls out for large images then the responsive route is not for you. But maybe all sites should move away from this and designers should be encouraged to come up with design solutions rather than rely on technical ones.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The argument over context versus content can be viewed in a similar light. The use of a mobile device does not necessarily imply the user is away from their desktop computer - browsing on a mobile whilst at home is increasingly common. In other words changing the content for different devices is the wrong approach - changing how that content is presented is a better one.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Responsive Web Design is, to my mind, primarily about adopting a different philosophy to the development of sites - beginning with mobile devices - which should lead to the adoption of better practices on all devices. The mobile-enabled world into which we are now moving presents us with challenges for sure but, armed with a clear idea of how to approach these, and with good concepts of user-oriented design these are challenges we should relish. It is early days for the responsive approach but we as developers have the opportunity to break the chains binding us to the practices of yesterday and take a step towards declaring the web as its own medium. And that&#039;s quite a revolutionary idea!]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[]]&gt;&lt;/para&gt;&lt;/article&gt;\n'),(5,'the-assange-debate-leads-merrily-down-a-blind-alley-5','2012-08-23 22:27:19','The Assange debate leads merrily down a blind alley','&lt;?xml version=&quot;1.0&quot;?&gt;\n&lt;article&gt;&lt;para&gt;&lt;![CDATA[]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[I&#039;ve spent a fair bit of the last few days following the debate surrounding WikiLeaks founder Julian Assange, as he remains holed up in the Ecuadorian embassy in London. Over that time I have become increasingly dismayed at the way this has proceeded, and in particular how the British left has been split down the middle over the issue. I have been angry too at how the level of debate has sunk so low. I find it hard to remember an issue that has proved so divisive, and that has driven journalists and writers whose work I otherwise respect to contribute such poor analysis and resort so easily to name-calling - and I&#039;ve been around a bit.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[When talking of Assange supporters or critics we clearly need to be aware that each of these broad categories covers a wide range of opinion. Nonetheless his supporters generally have in common the claim that he would be in grave danger if he were to be extradited to the USA on charges relating to WikiLeaks&#039; activities, and that such an extradition would be the likely outcome of his being returned first to Sweden to face allegations of rape so this must be avoided at all costs. His critics meanwhile have grasped the tendency of some of their opponents to downplay the rape accusations in one way or another and to appeal to the existing laws of Sweden and the UK to prove that he must return to Sweden. This they do with a mixture of complacency and lack of interest in the possibility that the USA may also become involved. Sadly it doesn&#039;t rise much above that.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[What has probably angered me most in the debate has been the way two principles have been counter-posed: as if we are being forced by this issue to choose which trumps which - women&#039;s rights or freedom of speech. From where I am though it seems pretty clear. Assange should be protected from the probable attempts by the USA to extradite him. For me there is no doubt that they would like to use him through something akin to a show-trial to demonstrate what happens to those who reveal the truth about their actions in Iraq, Afghanistan and elsewhere. If this were to be allowed to happen it would be a massive blow against the principle of free speech and it must be resisted. Does that mean we should be happy to see him escape the allegations in Sweden? Definitely not. They are very serious and he must be made to answer them, whether that happens by Sweden undertaking to resist US extradition requests or the legal process happening, partially at least, in a third country. Anyone who supports the principles of free speech and women&#039;s rights should unite to ensure that both of these come to pass.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[So just why are so many convinced that they are being forced into making this choice? It seems to  be the result of three combined factors which together create a poisonous climate in which a proper debate cannot take place.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The first of these is the specific allegations made in Sweden. The sexual nature of these is guaranteed to drive a wedge between campaigners. It has also allowed a climate of misogyny to enter the debate as many of Assange&#039;s defenders try to minimise the seriousness of these and has led in turn to the accusation from many of his critics that pretty much everyone who defends him from possible US intervention, irrespective of the merit of their arguments, is a rape apologist.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The second factor is the personalisation of the issue around Assange himself. The sneering at the balcony appearance and other various judgements on his character have no place in this debate. They are irrelevant. This isn&#039;t centrally about Julian Assange. This is about two central principles. If we get it right in this case the fight for both of those principles could be massively strengthened. Get it wrong - and that&#039;s where we are heading right now - and one, or more likely both, will be weakened.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[Finally I have been angered by the way that so much of the so-called debate has been conducted on the basis of existing law. Liberal lawyer David Allen Green has become the spokesperson for this tendency through his recent New Statesman article and this has been dutifully quoted from numerous times to conclude that the existing law can be the only arbiter of what happens. But this misses the crucial point that the law remains in the last resort not a neutral force, standing above politics, but a tool for the maintenance of existing power structures. No-one who has been involved in an industrial dispute can deny this. But this week I have been witnessed otherwise respectable figures on the left stagger up to the insurmountable barrier of the law over whether Swedish police could come to the UK to interview Assange. Or whether Sweden would extradite him anyway. The otherwise brilliant journalist Owen Jones in his article in The Independent, while correctly demanding that Assange stands trial is particularly complacent on these points.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[The combination of these three factors has led the British left down a total blind alley, where spiteful name-calling has replaced genuine debate. My plea now is for all who want to see justice served wise up and help see this through to a progressive end. This impasse could be solved if the political will was there and people who want to see justice served for Assange&#039;s alleged victims whilst maintaining the right of freedom of speech stood up together and demanded it.]]&gt;&lt;/para&gt;&lt;para&gt;&lt;![CDATA[]]&gt;&lt;/para&gt;&lt;/article&gt;\n');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tag_names`
--

DROP TABLE IF EXISTS `blog_tag_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tag_names` (
  `tagNameId` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  PRIMARY KEY (`tagNameId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tag_names`
--

LOCK TABLES `blog_tag_names` WRITE;
/*!40000 ALTER TABLE `blog_tag_names` DISABLE KEYS */;
INSERT INTO `blog_tag_names` VALUES (1,'football'),(2,'racism'),(3,'Liverpool'),(4,'politics'),(5,'Sun on Sunday'),(6,'Rupert Murdoch'),(7,'nothing'),(8,'web design'),(9,'responsive web design'),(10,'web development'),(11,'WikiLeaks'),(12,'Julian Assange');
/*!40000 ALTER TABLE `blog_tag_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tags` (
  `tagId` int(11) NOT NULL AUTO_INCREMENT,
  `tagNameId` int(11) DEFAULT NULL,
  `postId` int(11) DEFAULT NULL,
  PRIMARY KEY (`tagId`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tags`
--

LOCK TABLES `blog_tags` WRITE;
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;
INSERT INTO `blog_tags` VALUES (9,8,4),(10,9,4),(11,10,4);
/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-25 20:23:34
