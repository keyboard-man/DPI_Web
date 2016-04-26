本路径下的add.conf ser.conf del.conf三个配置文件是用来在网页上显示的
其余的add_1.conf add_2.conf add_3.conf 
ser_1.conf ser_2.conf ser_3.conf del_1.conf del_2.conf del_3.conf
文件用来具体配置相关命令参数

add命令的method有
1--AddFullAcl				2--AddSmpAcl

ser命令的method有
1--QrySrvTypeRuleContent	2--QrySglRltRuleConTent
3--QryNetRuleContent		4--QryAllRuleContent
5--QrySrvTypeRule			6--QryStatSrvType
7--QryStatRuleType			8--QryNetRuleCount
9--QryAllRuleCount

del命令的method有
1--DelSrvTypeRuleContent	2--DelRuleType
3--DelSglRule				4--DelSglRuleRelated
5--DelNetRule				6--DelAllRule

ice操作保存至数据库List.log
{time:"2014-02-21 10:51:23",command:"AddFullAcl",id:"Add_1",user:"admin",rstCode:1}
