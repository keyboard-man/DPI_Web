#ifndef CMD_TO_MCCN_ICE
#define CMD_TO_MCCN_ICE

#include "comm.ice"

module CmdTxRxICE 
{
	interface CmdToMCCN
	{
		RespAddSmpAcl mccnAddSmpAcl (CmdAddSmpAcl cmd);
		RespAddFullAcl mccnAddFullAcl (CmdAddFullAcl cmd);

		RespQrySrvTypeRule mccnQrySrvTypeRule(CmdQrySrvTypeRule cmd);
		RespQrySrvTypeRuleContent mccnQrySrvTypeRuleContent(CmdQrySrvTypeRuleContent cmd);
		RespQryStatSrvType mccnQryStatSrvType(CmdQryStatSrvType cmd);
		RespQryStatRuleType mccnQryStatRuleType (CmdQryStatRuleType cmd);
		RespQrySglRltRuleContent mccnQrySglRltRuleContent (CmdQrySglRltRuleContent cmd);
		RespQrySglRltRuleCount mccnQrySglRltRuleCount (CmdQrySglRltRuleCount cmd);
		RespQryNetRuleContent mccnQryNetRuleContent (CmdQryNetRuleContent cmd);
		RespQryNetRuleCount mccnQryNetRuleCount (CmdQryNetRuleCount cmd);
		RespQryAllRuleContent mccnQryAllRuleContent (CmdQryAllRuleContent cmd);
		RespQryAllRuleCount mccnQryAllRuleCount (CmdQryAllRuleCount cmd);
		

		RespDelSrvTypeRuleContent mccnDelSrvTypeRuleContent (CmdDelSrvTypeRuleContent cmd);
		RespDelRuleType mccnDelRuleType (CmdDelRuleType cmd);
		RespDelSglRule mccnDelSglRule (CmdDelSglRule cmd);
		RespDelSglRuleRelated mccnDelSglRuleRelated (CmdDelSglRuleRelated cmd);
		RespDelNetRule mccnDelNetRule (CmdDelNetRule cmd);
		RespDelAllRule mccnDelAllRule (CmdDelAllRule cmd);

		RespQuit mccnQuit (CmdQuit cmd);
	};
};

#endif
