#ifndef COMM_ICE
#define COMM_ICE

module CmdTxRxICE 
{
	struct UsrInfo
	{
		string name;
		string pwd;
	};
	struct Dpi
	{
		int ip;
		short port;
		string id;
	};
	sequence<Dpi> DPIVector;

	struct CmdPubInfo
	{
		UsrInfo usr;
		byte srvId;
		DPIVector dpiList;
	};
	struct RespPubInfo
	{
		int exCode;//标示异常情况
	};

	struct SmpAclInfo
	{      
		byte ruleDirection;//单向：0；双向：1
		int srcIP;
		int dstIP;
		short srcPort;
		short dstPort;
		byte protocalId;
	};


	struct FullAclInfo
	{      
		byte ruleDirection;//单向：0；双向：1
		byte srvId;
		int   srcIP;
		int   dstIP;
		short srcPort;
		short dstPort;
		short protocalId;
		int   srcIPMask;
		int   dstIPMask;
		short srcPortMask;
		short dstPortMask;
		short protocalIdMask;
	};
	struct FeedbkMb//反馈消息块
	{      
		FullAclInfo acl;
		int ruleId;
		int hitCount;
		int recvTime;
		int cltIp;
		int usrName;
	};
	sequence<FeedbkMb> FeedbkVector;

	struct NetInfo
	{
		short type;//0:只指定源IP；1:只指定目的IP；2：源和目的都指定
		int srcIpBgn;
		int srcIpEnd;
		int dstIpBgn;
		int dstIpEnd;
	};

	struct CmdAddSmpAcl
	{
		CmdPubInfo pubInfo;
		SmpAclInfo acl;
	};
	struct RespAddSmpAcl
	{
		RespPubInfo exInfo;
		int rstCode;
	};

	struct CmdAddFullAcl
	{
		CmdPubInfo pubInfo;
		FullAclInfo acl;
	};
	struct RespAddFullAcl
	{
		RespPubInfo exInfo;
		int rstCode;

	};

	struct CmdQrySrvTypeRule
	{
		CmdPubInfo pubInfo;
		int srvId;

	};
	struct RespQrySrvTypeRule
	{
		RespPubInfo exInfo;
		int ruleCount;
		int hitCount;
	};

	struct CmdQrySrvTypeRuleContent
	{
		CmdPubInfo pubInfo;
		int srvId;
	};
	struct RespQrySrvTypeRuleContent
	{
		RespPubInfo exInfo;
		FeedbkVector mbVct;
	};

	struct CmdQryStatSrvType
	{
		CmdPubInfo pubInfo;
	};

	struct SrvTypeInfo
	{
		short type;
		int thisRuleCount;
		int thisHitCount;
	};
	sequence<SrvTypeInfo> SrvTypeInfoVector;
	struct RespQryStatSrvType
	{
		RespPubInfo exInfo;
		int ruleCount;
		int denyCount;
		int redirectCount;
		int inUseSrvTypeCount;
		SrvTypeInfoVector typeInfoVct;
	};

	struct RuleTypeInfo
	{
		short type;
		int thisRuleCount;
		int thisHitCount;
	};
	sequence<RuleTypeInfo> RuleTypeInfoVector;

	struct CmdQryStatRuleType
	{
		CmdPubInfo pubInfo;
	};
	struct RespQryStatRuleType
	{
		RespPubInfo exInfo;
		int ruleCount;
		int denyCount;
		int redirectCount;
		int inUseRuleTypeCount;
		RuleTypeInfoVector typeInfoVct;
	};

	struct CmdQrySglRltRuleContent
	{//查询单条相关规则内容
		CmdPubInfo pubInfo;
		FullAclInfo acl;
	};
	struct RespQrySglRltRuleContent
	{
		RespPubInfo exInfo;
		FeedbkVector mbVct;
	};

	struct CmdQrySglRltRuleCount
	{//查询单条相关规则数目
		CmdPubInfo pubInfo;
		FullAclInfo acl;
	};
	struct RespQrySglRltRuleCount
	{
		RespPubInfo exInfo;
		int a;
	};

	struct CmdQryNetRuleCount
	{//查询网段规则数目
		CmdPubInfo pubInfo;
		NetInfo net;
	};
	struct RespQryNetRuleCount
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdQryNetRuleContent
	{//查询网段规则内容
		CmdPubInfo pubInfo;
		NetInfo net;
	};
	struct RespQryNetRuleContent
	{
		RespPubInfo exInfo;
		FeedbkVector mbVct;
	};

	struct CmdQryAllRuleCount
	{//查询全部规则数目
		CmdPubInfo pubInfo;
	};
	struct RespQryAllRuleCount
	{
		RespPubInfo exInfo;
		int ruleCount;
	};


	struct CmdQryAllRuleContent
	{//查询全部规则内容
		CmdPubInfo pubInfo;
	};
	struct RespQryAllRuleContent
	{
		RespPubInfo exInfo;
		FeedbkVector mbVct;
	};

	struct CmdDelSrvTypeRuleContent
	{//
		CmdPubInfo pubInfo;
		int srvId;//id即type;
	};
	struct RespDelSrvTypeRuleContent
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdDelRuleType
	{//
		CmdPubInfo pubInfo;
		int ruleType;
	};
	struct RespDelRuleType
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdDelSglRule
	{//
		CmdPubInfo pubInfo;
		FullAclInfo acl;
	};
	struct RespDelSglRule
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdDelSglRuleRelated
	{//
		CmdPubInfo pubInfo;
		FullAclInfo acl;
	};
	struct RespDelSglRuleRelated
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdDelNetRule
	{//
		CmdPubInfo pubInfo;
		NetInfo net;
	};
	struct RespDelNetRule
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdDelAllRule
	{//
		CmdPubInfo pubInfo;
	};
	struct RespDelAllRule
	{
		RespPubInfo exInfo;
		int ruleCount;
	};

	struct CmdQuit
	{//
		CmdPubInfo pubInfo;
	};
	struct RespQuit
	{
		RespPubInfo exInfo;
		int rstCode;
	};

};
#endif
