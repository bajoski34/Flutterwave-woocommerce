/**
 * External dependencies
 */
import { useSelect, useDispatch } from "@wordpress/data";

/**
 * Internal dependencies
 */
import { STORE_NAME } from "../../constants/index";
export const useIsWCFLutterwaveEnabled = () => {
  const { updateIsWCFlutterwaveEnabled } = useDispatch(STORE_NAME);

  return useSelect(
    (select) => {
      const { getIsWCFlutterwaveEnabled } = select(STORE_NAME);

      return [getIsWCFlutterwaveEnabled(), updateIsWCFlutterwaveEnabled];
    },
    [updateIsWCPayEnabled]
  );
};
